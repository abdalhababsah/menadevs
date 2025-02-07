<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkipReason extends Model
{
    use HasFactory;
    protected $fillable = ['reason'];

    // A SkipReason can have many TaskSkips.
    public function taskSkips()
    {
        return $this->hasMany(TaskSkip::class);
    }
}