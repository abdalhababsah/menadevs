<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dimension extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description'];

    // A Dimension belongs to many Tasks
    public function tasks()
    {
        return $this->belongsToMany(Task::class, 'task_dimensions')->withPivot('rating', 'justification', 'filled_by')->withTimestamps();
    }
    public function taskDimensions()
{
    return $this->hasMany(TaskDimension::class);
}
}