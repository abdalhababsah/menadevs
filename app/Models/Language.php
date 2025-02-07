<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    // A Language has many Settings.
    public function settings()
    {
        return $this->hasMany(Setting::class);
    }

    // A Language has many PreferredLanguage entries.
    public function preferredLanguages()
    {
        return $this->hasMany(PreferredLanguage::class);
    }
}