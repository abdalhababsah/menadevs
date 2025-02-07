<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attempt extends Model
{
    use HasFactory;
    protected $fillable = [
        'task_id',
        'attempter_response',
        'chosen_response',
        'justification',
        'attempter_id',
        'start_time',
        'end_time',
        'duration_seconds'
    ];

    // An Attempt belongs to a Task.
    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    // An Attempt belongs to a User (as attempter).
    public function attempter()
    {
        return $this->belongsTo(User::class, 'attempter_id');
    }

    // An Attempt may have one CompletedTask.
    public function completedTask()
    {
        return $this->hasOne(CompletedTask::class);
    }
}