<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLogin extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'login_time', 'ip_address', 'location'];

    // A UserLogin belongs to a User.
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}