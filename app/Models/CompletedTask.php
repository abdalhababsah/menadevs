<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompletedTask extends Model
{
    use HasFactory;
    protected $fillable = ['task_id', 'attempt_id'];

    // A CompletedTask belongs to a Task.
    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    // A CompletedTask belongs to an Attempt.
    public function attempt()
    {
        return $this->belongsTo(Attempt::class);
    }
}