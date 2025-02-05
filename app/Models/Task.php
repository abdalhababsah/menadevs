<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_task_id',
        'task_description',
        'response_1',
        'response_2',
        'settings_id'
    ];

    // If this task is a reattempt, it belongs to a parent task.
    public function parentTask()
    {
        return $this->belongsTo(Task::class, 'parent_task_id');
    }

    // A task can have many reattempts.
    public function childTasks()
    {
        return $this->hasMany(Task::class, 'parent_task_id');
    }

    // A task belongs to a specific setting.
    public function settings()
    {
        return $this->belongsTo(Setting::class, 'settings_id');
    }

    // A task can have many attempts.
    public function attempts()
    {
        return $this->hasMany(Attempt::class);
    }

    // A task can have many reviews.
    public function attemptsReviewers()
    {
        return $this->hasMany(AttemptsReviewer::class);
    }

    // A task can have many dimensions.
    public function dimensions()
    {
        return $this->hasMany(Dimension::class);
    }

    // A task can be marked as completed by linking to an attempt.
    public function completedTasks()
    {
        return $this->hasMany(CompletedTask::class);
    }
}