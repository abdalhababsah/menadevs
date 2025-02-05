<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CompletedTask extends Model
{
    use HasFactory;

    protected $fillable = [
        'task_id',
        'attempt_id'
    ];

    // The completed task belongs to a task.
    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    // The completed task belongs to an attempt.
    public function attempt()
    {
        return $this->belongsTo(Attempt::class);
    }
}