<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Language extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    // A language can have multiple settings.
    public function settings()
    {
        return $this->hasMany(Setting::class);
    }

    // A language can be selected by many users as their preferred language.
    public function preferredLanguages()
    {
        return $this->hasMany(PreferredLanguage::class);
    }
}