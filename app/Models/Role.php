<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    // A Role has many Users.
    public function users()
    {
        return $this->hasMany(User::class);
    }

    // A Role has many activity logs.
    public function activityLogs()
    {
        return $this->hasMany(UserActivityLog::class);
    }
}