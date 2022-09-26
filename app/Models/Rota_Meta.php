<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rota_Meta extends Model
{
    protected $table = 'rota_metas';

    use HasFactory;

    protected $guarded = ['id'];

    public function appointment()
    {
        return $this->belongsTo(Appointment::class, 'user_id');
    }

    public function rota()
    {
        return $this->belongsTo(Rota::class, 'rota_id');
    }
}
