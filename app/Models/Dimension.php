<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dimension extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'justification',
        'filled_by',
        'task_id'
    ];

    // The user who filled out this dimension.
    public function user()
    {
        return $this->belongsTo(User::class, 'filled_by');
    }

    // The task this dimension belongs to.
    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}