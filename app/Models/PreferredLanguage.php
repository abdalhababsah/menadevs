<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PreferredLanguage extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'language_id'
    ];

    // The user who prefers this language.
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // The language that is preferred.
    public function language()
    {
        return $this->belongsTo(Language::class);
    }
}