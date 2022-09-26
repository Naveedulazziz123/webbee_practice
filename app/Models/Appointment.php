<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user()
    {
        return $this->hasMany(User::class);
    }

    public function shop()
    {
        return $this->hasMany(Shop::class);
    }

    public function service()
    {
        return $this->hasMany(Service::class);
    }

    public function rota()
    {
        return $this->hasMany(Rota::class);
    }

    public function rota_meta()
    {
        return $this->belongsTo(Rota_Meta::class);
    }
}
