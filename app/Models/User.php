<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    protected $guarded = ['id'];

    public function usertype()
    {
        return $this->hasOne(UserType::class);
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class, 'shope_id');
    }

    public function appointment()
    {
        return $this->belongsTo(Appointment::class, 'user_id');
    }

}
