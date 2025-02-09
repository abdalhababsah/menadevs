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
        'attempter_id',
        'response_1',
        'response_2',
        'settings_id',
        'uploaded_file',
        'tasker_instruction_to_reviewer'
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
    public function taskDimensions()
    {
        return $this->hasMany(TaskDimension::class);
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

    // A Task belongs to a Category through Setting
    public function category()
    {
        return $this->hasOneThrough(Category::class, Setting::class, 'id', 'id', 'settings_id', 'category_id');
    }

    // A Task belongs to a Language through Setting
    public function language()
    {
        return $this->hasOneThrough(Language::class, Setting::class, 'id', 'id', 'settings_id', 'language_id');
    }

    // A Task has many Dimensions via TaskDimension
    public function dimensions()
    {
        return $this->hasManyThrough(Dimension::class, TaskDimension::class, 'task_id', 'id', 'id', 'dimension_id');
    }
        // An Attempt belongs to a User (as attempter).
        public function attempter()
        {
            return $this->belongsTo(User::class, 'attempter_id');
        }
}