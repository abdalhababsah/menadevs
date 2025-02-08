<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $fillable = ['category_id', 'language_id', 'max_review_level','reviewing_duration_minutes','attempting_duration_minutes'];

    // A Setting belongs to a Category.
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // A Setting belongs to a Language.
    public function language()
    {
        return $this->belongsTo(Language::class);
    }

    // A Setting has many Tasks.
    public function tasks()
    {
        return $this->hasMany(Task::class, 'settings_id');
    }
}