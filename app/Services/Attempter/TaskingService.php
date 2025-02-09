<?php

namespace App\Services\Attempter;

use App\Models\Task;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TaskingService
{
    /**
     * Main method to get the next task for the logged-in attempter.
     *
     * @param  \App\Models\User  $user
     * @return object|null
     */
    public function startTasking($user)
    {
        $task = null;

        // Priority 1: Look for a rejected task chain for this user.
        $rejectedTask = $this->getLatestRejectedTask($user);
        if ($rejectedTask) {
            $task = $rejectedTask;
        } else {
            // Priority 2: Look for tasks where the attempter has skipped his rejected task.
            $skippedTask = $this->getTaskForSkippedRejectedTask($user);
            if ($skippedTask) {
                $task = $skippedTask;
            } else {
                // Priority 3: Select an unattempted task that has no parent, is unclaimed,
                // and whose language matches one of the user's preferred languages.
                $task = $this->getUnattemptedTask($user);
            }
        }

        if ($task) {
            // Update claim_time to now.
            DB::table('tasks')
                ->where('id', $task->id)
                ->update(['claim_time' => Carbon::now()]);
        }

        return $task;
    }

    /**
     * Traverse a task chain by following unclaimed children until no further child exists.
     *
     * @param \App\Models\Task $task
     * @return \App\Models\Task
     */
    protected function traverseTaskChain(Task $task)
    {
        $current = $task;
        while (true) {
            // Get the most recent child task (if any) that is unclaimed.
            $child = Task::where('parent_task_id', $current->id)
                ->whereNull('claim_time')
                ->orderBy('created_at', 'desc')
                ->first();

            if (!$child) {
                break;
            }
            $current = $child;
        }
        return $current;
    }

    /**
     * Get the latest (last child) rejected task in the chain for the given user.
     *
     * A rejected task is defined as one that the logged-in user attempted (its ID appears in the
     * attempts table for that user) and which has a corresponding record in attempts_reviewer
     * with a rating of 1 or 2.
     * We then traverse its children to get the final unclaimed version.
     * We also ensure the final task has not been skipped by the user.
     *
     * @param  \App\Models\User  $user
     * @return object|null
     */
    protected function getLatestRejectedTask($user)
    {
        $sql = "
            WITH RECURSIVE task_chain AS (
                -- Anchor: start with tasks that the user attempted and that have been reviewed with a rejection rating.
                SELECT t.*, 0 AS depth
                FROM tasks t
                JOIN attempts_reviewer ar ON ar.task_id = t.id
                WHERE t.id IN (
                    SELECT task_id FROM attempts WHERE attempter_id = ?
                )
                  AND (ar.rating = 1 OR ar.rating = 2)
                  AND t.claim_time IS NULL
                UNION ALL
                -- Recursive part: get child tasks.
                SELECT child.*, tc.depth + 1 AS depth
                FROM tasks child
                JOIN task_chain tc ON child.parent_task_id = tc.id
                WHERE child.claim_time IS NULL
            )
            SELECT *
            FROM task_chain
            ORDER BY depth DESC
            LIMIT 1
        ";

        $results = DB::select($sql, [$user->id]);

        return count($results) ? $results[0] : null;
    }

    /**
     * Get a task from the chain that was skipped by the attempter,
     * and ensure that the task's language (via its setting) matches the attempter's preferred languages.
     *
     * @param  \App\Models\User  $user
     * @return object|null
     */
    protected function getTaskForSkippedRejectedTask($user)
    {
        $sql = "
            WITH RECURSIVE skipped_chain AS (
                -- Anchor: start with tasks that the user has skipped.
                SELECT t.*, 0 AS depth
                FROM tasks t
                JOIN task_skips ts ON ts.task_id = t.id
                JOIN settings s ON s.id = t.settings_id
                WHERE ts.user_id = ?
                  AND t.claim_time IS NULL
                  AND s.language_id IN (SELECT language_id FROM preferred_languages WHERE user_id = ?)
                UNION ALL
                -- Recursive part: get child tasks.
                SELECT child.*, sc.depth + 1 AS depth
                FROM tasks child
                JOIN skipped_chain sc ON child.parent_task_id = sc.id
                JOIN settings s ON s.id = child.settings_id
                WHERE child.claim_time IS NULL
                  AND s.language_id IN (SELECT language_id FROM preferred_languages WHERE user_id = ?)
            )
            SELECT *
            FROM skipped_chain
            ORDER BY depth DESC
            LIMIT 1
        ";

        $results = DB::select($sql, [$user->id, $user->id, $user->id]);

        return count($results) ? $results[0] : null;
    }

    /**
     * Get an unattempted, unclaimed task that has no parent
     * and whose language (via its setting) matches one of the user's preferred languages.
     *
     * @param  \App\Models\User  $user
     * @return \App\Models\Task|null
     */
    protected function getUnattemptedTask($user)
    {
        $preferredLanguageIds = $user->preferredLanguages()->pluck('language_id')->toArray();

      $task=  Task::whereNull('parent_task_id')
            ->whereNull('claim_time')
            ->whereDoesntHave('attempts')
            ->whereHas('setting', function ($q) use ($preferredLanguageIds) {
                $q->whereIn('language_id', $preferredLanguageIds);
            })
            ->first();
            // dd(  $task );

            return $task;
    }

}