<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserLogin extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'login_time',
        'ip_address',
        'location'
    ];

    // A login record belongs to a user.
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}