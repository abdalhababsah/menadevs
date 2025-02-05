<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'language_id',
        'max_review_level'
    ];

    // A setting belongs to a category.
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // A setting belongs to a language.
    public function language()
    {
        return $this->belongsTo(Language::class);
    }

    // A setting can be associated with many tasks.
    public function tasks()
    {
        return $this->hasMany(Task::class, 'settings_id');
    }
}