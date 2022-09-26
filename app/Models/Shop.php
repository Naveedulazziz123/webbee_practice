<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function appointment()
    {
        return $this->belongsTo(Appointment::class, 'user_id');
    }

    public function rota_meta()
    {
        return $this->hasManyThrough(Rota_Meta::class, Rota::class, 'shop_id', 'rota_id');
    }


    public function breaks(){
        return $this->hasMany(Breaks::class);
    }

    public function rota(){
        return $this->hasOne(Rota::class);
    }





}
