<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreferredLanguage extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'language_id'];

    // A PreferredLanguage belongs to a User.
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // A PreferredLanguage belongs to a Language.
    public function language()
    {
        return $this->belongsTo(Language::class);
    }
}