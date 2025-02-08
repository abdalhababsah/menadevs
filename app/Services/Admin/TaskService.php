<?php
namespace App\Services\Admin;

use App\Models\Task;
use App\Models\Setting;
use App\Models\TaskDimension;
use Illuminate\Support\Facades\DB;

class TaskService
{
    /**
     * Create a new task with dimensions and duplicate it based on input count.
     */
    public function createTask(array $data)
    {
        return DB::transaction(function () use ($data) {
            // Find or create a Setting entry based on category_id and language_id
            $setting = Setting::firstOrCreate([
                'category_id' => $data['category_id'],
                'language_id' => $data['language_id'],
            ], [
                'max_review_level' => $data['max_review_level'] ?? 3,
                'reviewing_duration_minutes' => $data['reviewing_duration_minutes'],
                'attempting_duration_minutes' => $data['attempting_duration_minutes'],
            ]);

            $taskCount = $data['task_count'] ?? 1;
            $taskCount = min($taskCount, 100); // Ensure it does not exceed 100

            $createdTasks = [];
            for ($i = 0; $i < $taskCount; $i++) {
                $task = Task::create([
                    'task_description' => $data['task_description'],
                    'settings_id' => $setting->id, 
                ]);

                // Create TaskDimension records using selected dimensions
                if (!empty($data['dimensions'])) {
                    foreach ($data['dimensions'] as $dimensionId) {
                        TaskDimension::create([
                            'task_id' => $task->id,
                            'dimension_id' => $dimensionId,
                        ]);
                    }
                }

                $createdTasks[] = $task;
            }

            return $createdTasks;
        });
    }


        /**
         * Get all available tasks (where claim_time is null) with optional filters and dimensions.
         *
         * @param array $filters
         * @return array
         */
        public function getAvailableTasks(array $filters): array
        {
            $query = Task::with(['category', 'language', 'dimensions'])
                ->whereNull('claim_time');
        
            // Apply category filter (through settings)
            if (!empty($filters['category_id'])) {
                $query->whereHas('setting', function ($q) use ($filters) {
                    $q->where('category_id', $filters['category_id']);
                });
            }
        
            // Apply language filter (through settings)
            if (!empty($filters['language_id'])) {
                $query->whereHas('setting', function ($q) use ($filters) {
                    $q->where('language_id', $filters['language_id']);
                });
            }
        
            // Paginate results
            $tasks = $query->paginate(10);
        
            // Count of total available tasks
            $count = $query->count();
        
            return [
                'tasks' => $tasks,
                'count' => $count,
            ];
        }
}