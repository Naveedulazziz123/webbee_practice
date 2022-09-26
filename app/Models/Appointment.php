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
        return $this->belongsTo(User::class);
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

    /**
     * Check is that appintment come between breaks
     */
    public static function is_break($first_time, $end_time, $request, $rota, $rota_meta){

        $is_appointment_come_in_break = Breaks::where(function ($query) use ($first_time, $end_time) {
            $query->where(function ($query) use ($first_time, $end_time) {
                $query->where('start_time', '<=', $first_time)
                    ->where('end_time', '>', $first_time);
            })
                ->orWhere(function ($query) use ($first_time, $end_time) {
                    $query->where('start_time', '<', $end_time)
                        ->where('end_time', '>=', $end_time);
                });
        })
            ->where([
                ['shop_id', '=', $request->shop_id],
                ['rota_id', '=', $rota->id],
                ['rota_meta_id', '=', $rota_meta->id]
            ])->count();

        if($is_appointment_come_in_break == 0) {
            return true;
        } else {
            return false;
        }
    }


}
