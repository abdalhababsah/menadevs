<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AttemptsReviewer extends Model
{
    use HasFactory;

    // Since the table name is not the plural of the model, we set it explicitly.
    protected $table = 'attempts_reviewer';

    protected $fillable = [
        'task_id',
        'attempter_id',
        'rating',
        'feedback',
        'status'
    ];

    // A review belongs to a task.
    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    // A review belongs to a user (the tasker being reviewed).
    public function user()
    {
        return $this->belongsTo(User::class, 'attempter_id');
    }
}