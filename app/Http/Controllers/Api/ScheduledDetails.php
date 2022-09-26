<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use \App\Models\Rota_Meta;
use \App\Models\User;
use Illuminate\Support\Arr;

class ScheduledDetails extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $schedule_details = [];
        $start_date = @$request['start_date'] ? $request['start_date'] : Carbon::now()->format('Y-m-d');
        $end_date   = @$request['end_date'] ? $request['end_date'] : Carbon::now()->format('Y-m-d');

        $user_details = @User::with(['shop.rota_meta' => function($q) use ($start_date, $end_date) {
            return $q->whereBetween('date', [$start_date, $end_date]);
        } ,'appointment' => function($q) use ($start_date, $end_date) {
            return $q->whereBetween('schedule_date', [$start_date, $end_date]);
        },'shop.breaks' => function($q) use ($start_date, $end_date) {
            return $q->whereBetween('date', [$start_date, $end_date]);
        }])->where('user_type_id', 2)->first();

        if(isset($user_details->shop) && !empty($user_details->shop['rota_meta'])){
            foreach($user_details->shop['rota_meta'] as $data){
                $schedule_data[$data['date']] = [
                    'rota_meta' => @$user_details['shop']['rota_meta']->filter(function($v) use($data){
                        return $v['date'] == $data['date'];
                    }),
                    'breaks' =>  @$user_details['shop']['breaks']->filter(function($v) use($data){
                        return $v['date'] == $data['date'];
                    }),
                    'appointment' => @$user_details['appointment']->filter(function($v) use($data){
                        return $v['schedule_date'] == $data['date'];
                    }),
                ];
                array_push($schedule_details,$schedule_data);
            }
        }
        return $schedule_data;

    }
}
