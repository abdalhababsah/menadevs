<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    // A category may have multiple settings.
    public function settings()
    {
        return $this->hasMany(Setting::class);
    }
}