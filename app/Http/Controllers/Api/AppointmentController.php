<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Rota;
use App\Models\Rota_Meta;
use Illuminate\Http\Request;
use App\Http\Requests\ApppointmentStoreRequest;
use Carbon\Carbon;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ApppointmentStoreRequest $request)
    {
        $schedule_date = Carbon::createFromFormat('Y-m-d', $request->schedule_date);
        $schedule_start_time = Carbon::createFromFormat('H:i:s', $request->schedule_start_time);
        $schedule_end_time = Carbon::createFromFormat('H:i:s', $request->schedule_end_time);

        // Get the Rota

        $rota = Rota::where('shop_id','=',$request->shop_id)
            ->whereDate('start_date','>=', $schedule_date)
            ->whereDate('end_date','>=', $schedule_date)
            ->first();

        // Rota Meta
        if($rota){

            $rota_meta = Rota_Meta::where('active', '=', '1')
                ->whereDate('date','=', $schedule_date)
                ->first();



            if($rota_meta){

                $appointments = Appointment::where([
                    ['shop_id', '=', $request->shop_id],
                    ['rota_id', '=', $rota->id],
                    ['rota_metas_id', '=', $rota_meta->id]
                ])
                    ->whereTime('schedule_start_time', '>=', $schedule_start_time)
                    ->whereTime('schedule_end_time', '<=', $schedule_end_time)
                    ->get();

                dd($appointments);

                foreach ($appointments as $appointment) {

                }

            } else {
                return response()->json([
                    'error' => 'Entry for not found'], 404);
            }
        } else {
         return 'Rota Not avail';
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function show(Appointment $appointment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function edit(Appointment $appointment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Appointment $appointment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Appointment $appointment)
    {
        //
    }
}
