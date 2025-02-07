<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskSkip extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'task_id', 'skip_reason_id', 'additional_notes'];

    // A TaskSkip belongs to a User.
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // A TaskSkip belongs to a Task.
    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    // A TaskSkip belongs to a SkipReason.
    public function skipReason()
    {
        return $this->belongsTo(SkipReason::class);
    }
}