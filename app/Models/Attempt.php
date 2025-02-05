<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attempt extends Model
{
    use HasFactory;

    protected $fillable = [
        'task_id',
        'attempter_response',
        'chosen_response',
        'justification',
        'attempter_id'
    ];

    // An attempt belongs to a task.
    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    // An attempt belongs to a user (the tasker).
    public function user()
    {
        return $this->belongsTo(User::class, 'attempter_id');
    }

    // An attempt may have one completed task record.
    public function completedTask()
    {
        return $this->hasOne(CompletedTask::class);
    }
}