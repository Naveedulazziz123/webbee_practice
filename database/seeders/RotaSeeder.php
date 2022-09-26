<?php

namespace Database\Seeders;

use App\Models\Rota;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class RotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Rota::insert([
           [
               'shop_id' => 1,
               'start_date' => '2022-09-26',
               'end_date' => '2022-10-02',
               'monday_start' => '08:00:00',
               'monday_end' => '20:00:00',
               'tuesday_start' => '08:00:00',
               'tuesday_end' => '20:00:00',
               'wednesday_start' => '08:00:00',
               'wednesday_end' => '20:00:00',
               'thursday_start' => '08:00:00',
               'thursday_end' => '20:00:00',
               'friday_start' => '08:00:00',
               'friday_end' => '20:00:00',
               'saturday_start' => '10:00:00',
               'saturday_end' => '22:00:00',
               'sunday_start' => null,
               'sunday_end' => null,
               'created_at' => Carbon::now(),
               'updated_at' => Carbon::now()
           ]
        ]);
    }
}
