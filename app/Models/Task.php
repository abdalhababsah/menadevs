<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable = [
        'parent_task_id',
        'task_description',
        'prompt',
        'response_1',
        'response_2',
        'settings_id',
    ];

    // A Task may have a parent Task.
    public function parentTask()
    {
        return $this->belongsTo(Task::class, 'parent_task_id');
    }

    // A Task may have many sub-tasks.
    public function subTasks()
    {
        return $this->hasMany(Task::class, 'parent_task_id');
    }

    // A Task belongs to a Setting.
    public function setting()
    {
        return $this->belongsTo(Setting::class, 'settings_id');
    }

    // A Task has many Attempts.
    public function attempts()
    {
        return $this->hasMany(Attempt::class);
    }

    // A Task has many AttemptReviewer entries.
    public function attemptReviews()
    {
        return $this->hasMany(AttemptReviewer::class);
    }

    // A Task has many CompletedTask entries.
    public function completedTasks()
    {
        return $this->hasMany(CompletedTask::class);
    }

    // A Task has many Dimensions.
    public function dimensions()
    {
        return $this->hasMany(Dimension::class);
    }

    // A Task has many Screenshots.
    public function screenshots()
    {
        return $this->hasMany(TaskScreenshot::class);
    }

    // A Task has many Activity Logs.
    public function activityLogs()
    {
        return $this->hasMany(UserActivityLog::class);
    }

    // A Task has many TaskSkips.
    public function taskSkips()
    {
        return $this->hasMany(TaskSkip::class);
    }
}