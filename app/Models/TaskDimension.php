<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskDimension extends Model
{
    use HasFactory;

    protected $table = 'task_dimensions'; 

    protected $fillable = [
        'task_id',
        'dimension_id',
        'rating',
        'justification',
        'filled_by',
    ];

    // A TaskDimension belongs to a Task
    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    // A TaskDimension belongs to a Dimension
    public function dimension()
    {
        return $this->belongsTo(Dimension::class);
    }

    // A TaskDimension may be filled by a User (Attempter)
    public function filledBy()
    {
        return $this->belongsTo(User::class, 'filled_by');
    }
}