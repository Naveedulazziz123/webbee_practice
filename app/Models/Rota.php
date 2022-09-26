<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rota extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function appointment()
    {
        return $this->belongsTo(Appointment::class, 'user_id');
    }

    public function rota(){
        return $this->hasMany(Rota::class, 'rota_id');
    }

    public function rota_meta()
    {
        return $this->hasMany(Rota_Meta::class);
    }

}
