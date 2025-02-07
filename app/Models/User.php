<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // For authentication
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'role_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // A User belongs to a Role.
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    // A User (as an attempter) has many Attempts.
    public function attempts()
    {
        return $this->hasMany(Attempt::class, 'attempter_id');
    }

    // A User (acting as a reviewer) may have many review entries.
    public function attemptReviews()
    {
        return $this->hasMany(AttemptReviewer::class, 'attempter_id');
    }

    // A User has many Dimensions (filled_by).
    public function dimensions()
    {
        return $this->hasMany(Dimension::class, 'filled_by');
    }

    // A User has many PreferredLanguage entries.
    public function preferredLanguages()
    {
        return $this->hasMany(PreferredLanguage::class);
    }

    // A User has many UserLogin records.
    public function userLogins()
    {
        return $this->hasMany(UserLogin::class);
    }

    // A User has many Activity Logs.
    public function activityLogs()
    {
        return $this->hasMany(UserActivityLog::class);
    }

    // A User has many TaskSkips.
    public function taskSkips()
    {
        return $this->hasMany(TaskSkip::class);
    }
}