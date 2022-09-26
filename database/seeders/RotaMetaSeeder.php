<?php

namespace Database\Seeders;

use App\Models\Rota_Meta;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class RotaMetaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Rota_Meta::insert([
            [
                'rota_id' => 1,
                'date' => '2022-09-26',
                'start_time' => '08:00:00',
                'end_time' => '20:00:00',
                'active' => 1,
                'slug' => 'present',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'rota_id' => 1,
                'date' => '2022-09-27',
                'start_time' => '08:00:00',
                'end_time' => '20:00:00',
                'active' => 1,
                'slug' => 'present',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'rota_id' => 1,
                'date' => '2022-09-28',
                'start_time' => '08:00:00',
                'end_time' => '20:00:00',
                'active' => 1,
                'slug' => 'holiday',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'rota_id' => 1,
                'date' => '2022-09-29',
                'start_time' => '08:00:00',
                'end_time' => '20:00:00',
                'active' => 1,
                'slug' => 'present',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'rota_id' => 1,
                'date' => '2022-09-30',
                'start_time' => '08:00:00',
                'end_time' => '20:00:00',
                'active' => 1,
                'slug' => 'present',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'rota_id' => 1,
                'date' => '2022-10-01',
                'start_time' => '10:00:00',
                'end_time' => '22:00:00',
                'active' => 1,
                'slug' => 'present',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]]);
    }
}
