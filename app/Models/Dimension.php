<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dimension extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'justification', 'filled_by', 'task_id'];

    // A Dimension belongs to a Task.
    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    // A Dimension belongs to a User (filled_by).
    public function filledBy()
    {
        return $this->belongsTo(User::class, 'filled_by');
    }
}