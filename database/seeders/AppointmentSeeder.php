<?php

namespace Database\Seeders;

use App\Models\Appointment;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AppointmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Appointment::insert([
            [
                'shop_id' => 1,
                'service_id' => 1,
                'user_id' => 1,
                'rota_id' => 1,
                'rota_metas_id' => 1,
                'schedule_date' => '2022-09-26',
                'schedule_start_time' => '08:10:00',
                'schedule_end_time' => '08:20:00',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'shop_id' => 1,
                'service_id' => 1,
                'user_id' => 1,
                'rota_id' => 1,
                'rota_metas_id' => 1,
                'schedule_date' => '2022-09-26',
                'schedule_start_time' => '09:00:00',
                'schedule_end_time' => '10:00:00',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'shop_id' => 1,
                'service_id' => 1,
                'user_id' => 1,
                'rota_id' => 1,
                'rota_metas_id' => 1,
                'schedule_date' => '2022-09-26',
                'schedule_start_time' => '10:00:00',
                'schedule_end_time' => '10:10:00',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ]);
    }
}
