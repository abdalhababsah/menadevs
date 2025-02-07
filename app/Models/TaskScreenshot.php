<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskScreenshot extends Model
{
    use HasFactory;
    protected $fillable = ['task_id', 'user_id', 'screenshot_url', 'captured_at'];

    // A TaskScreenshot belongs to a Task.
    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    // A TaskScreenshot belongs to a User.
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}