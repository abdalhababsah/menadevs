<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserActivityLog extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'task_id', 'role_id', 'started_at', 'ended_at', 'active_duration_seconds'];

    // An Activity Log belongs to a User.
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // An Activity Log may belong to a Task.
    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    // An Activity Log belongs to a Role.
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}