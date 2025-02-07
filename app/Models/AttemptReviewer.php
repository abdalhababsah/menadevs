<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttemptReviewer extends Model
{
    use HasFactory;
    protected $fillable = [
        'task_id',
        'attempter_id', // Reviewer user ID (as per your migration)
        'rating',
        'feedback',
        'status',
        'review_start_time',
        'review_end_time',
        'review_duration_seconds'
    ];

    // An AttemptReviewer belongs to a Task.
    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    // An AttemptReviewer belongs to a User (acting as reviewer).
    public function reviewer()
    {
        return $this->belongsTo(User::class, 'attempter_id');
    }
}