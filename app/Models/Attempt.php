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
    ];

    // An Attempt belongs to a Task.
    public function task()
    {
        return $this->belongsTo(Task::class);
    }



    // An Attempt may have one CompletedTask.
    public function completedTask()
    {
        return $this->hasOne(CompletedTask::class);
    }
}