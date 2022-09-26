<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Breaks;
use App\Models\Configuration;
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ApppointmentStoreRequest $request)
    {
        $schedule_date = Carbon::createFromFormat('Y-m-d', $request->schedule_date);
        $schedule_start_time = Carbon::createFromFormat('H:i:s', $request->schedule_start_time);
        $schedule_end_time = Carbon::createFromFormat('H:i:s', $request->schedule_end_time);

        // Get the Rota information
        $rota = Rota::where('shop_id', '=', $request->shop_id)
            ->whereDate('start_date', '>=', $schedule_date)
            ->whereDate('end_date', '>=', $schedule_date)
            ->first();

        // Rota Meta
        if ($rota) {
            $rota_meta = Rota_Meta::where('active', '=', '1')
                ->whereDate('date', '=', $schedule_date)
                ->first();
            if ($rota_meta) {

                // Check if already booked appointment overlap with new appointment
                $appointments = Appointment::where(function ($query) use ($schedule_start_time, $schedule_end_time) {
                    $query->where(function ($query) use ($schedule_start_time, $schedule_end_time) {
                        $query->where('schedule_start_time', '<=', $schedule_start_time)
                            ->where('schedule_end_time', '>', $schedule_start_time);
                    })
                        ->orWhere(function ($query) use ($schedule_start_time, $schedule_end_time) {
                            $query->where('schedule_start_time', '<', $schedule_end_time)
                                ->where('schedule_end_time', '>=', $schedule_end_time);
                        });
                })->count();

                if ($appointments == 0) {

                    // Now I need to check coming time slot come between rota time slot of that day
                    $rota_meta_check = Rota_Meta::where(function ($query) use ($schedule_start_time, $schedule_end_time) {
                        $query->where(function ($query) use ($schedule_start_time, $schedule_end_time) {
                            $query->where('start_time', '<=', $schedule_start_time)
                                ->where('end_time', '>', $schedule_start_time);
                        })
                            ->orWhere(function ($query) use ($schedule_start_time, $schedule_end_time) {
                                $query->where('start_time', '<', $schedule_end_time)
                                    ->where('end_time', '>=', $schedule_end_time);
                            });
                    })->where([
                        ['rota_id', '=', $rota_meta->id],
                        ['id', '=', $rota_meta->id]
                    ])->count();

                    if ($rota_meta_check == 1) {
                        // Now I need to make data slots
                        $userids = explode(',', $request->user_id);

                        $config_no_of_person = Configuration::where('slug', '=', 'no_of_person')->first();

                        $appointment_data = array();

                        if (count($userids) <= $config_no_of_person->data) {

                            $config_slot_time = Configuration::where('slug', '=', 'slot_mint')->first();
                            $config_buffer_time = Configuration::where('slug', '=', 'buffer_time')->first();

                            if (count($userids) > 1) {

                                $count = 0;

                                foreach ($userids as $user_id) {
                                    if($count == 0){
                                        $save_start_time = $schedule_start_time;
                                        $first_time = $schedule_start_time->copy();
                                        $save_end_time = $save_start_time->copy()->addMinute($config_slot_time->data);
                                    } else {
                                        $save_end_time = $save_start_time->copy()->addMinute($config_slot_time->data);
                                    }

                                    $appointment_data[] = array(
                                        'shop_id' => $request->shop_id,
                                        'service_id' => $request->service_id,
                                        'user_id' => $user_id,
                                        'rota_id' => $rota->id,
                                        'rota_metas_id' => $rota_meta->id,
                                        'schedule_date' => $schedule_date->toDateString(),
                                        'schedule_start_time' => $save_start_time->toTimeString(),
                                        'schedule_end_time' => $save_end_time->toTimeString(),
                                        'created_at' => carbon::now(),
                                        'updated_at' => carbon::now(),
                                    );

                                    $end_time = $save_end_time->copy();
                                    $save_start_time = $save_end_time->copy()->addMinute($config_buffer_time->data);;
                                    $count++;
                                }

                                if($first_time >= $schedule_start_time && $end_time <= $schedule_end_time){
                                    $is_appointment_come_in_break = Appointment::is_break($first_time, $end_time, $request, $rota, $rota_meta);
                                } else {
                                    return response()->json([
                                        'error' => 'Kindly increase the time slot, Appointment not mange'], 404);
                                }
                            } else {
                                $save_start_time = $schedule_start_time;
                                $save_end_time = $save_start_time->copy()->addMinute($config_slot_time->data);

                                $is_appointment_come_in_break = Appointment::is_break($save_start_time, $save_end_time, $request, $rota, $rota_meta);

                                $appointment_data[] = array(
                                    'shop_id' => $request->shop_id,
                                    'service_id' => $request->service_id,
                                    'user_id' => $request->user_id,
                                    'rota_id' => $rota->id,
                                    'rota_metas_id' => $rota_meta->id,
                                    'schedule_date' => $schedule_date->toDateString(),
                                    'schedule_start_time' => $save_start_time->toTimeString(),
                                    'schedule_end_time' => $save_end_time->toTimeString(),
                                    'created_at' => carbon::now(),
                                    'updated_at' => carbon::now(),
                                );
                            }
                            if($is_appointment_come_in_break){
                                Appointment::insert($appointment_data);
                                return response()->json([
                                    'message' => 'Appointment Save successfully'], 200);
                            } else {
                                return response()->json([
                                    'error' => 'Appointment come under break'], 404);
                            }
                        } else {
                            return response()->json([
                                'error' => 'No of person limited exceeded'], 404);
                        }
                    } else {
                        return response()->json([
                            'error' => 'barber is not available'], 404);
                    }
                } else {
                    return response()->json([
                        'error' => 'Appointment Already avail on this time, Kindly select another time'], 404);
                }
            } else {
                return response()->json([
                    'error' => 'Time slotes not avail'], 404);
            }
        } else {
            return response()->json([
                'error' => 'Time slotes not avail'], 404);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Appointment $appointment
     * @return \Illuminate\Http\Response
     */
    public function show(Appointment $appointment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Appointment $appointment
     * @return \Illuminate\Http\Response
     */
    public function edit(Appointment $appointment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Appointment $appointment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Appointment $appointment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Appointment $appointment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Appointment $appointment)
    {
        //
    }
}
