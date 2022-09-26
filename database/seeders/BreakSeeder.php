<?php

namespace Database\Seeders;

use App\Models\Breaks;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class BreakSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Breaks::insert([
            [
                'shop_id' => 1,
                'rota_id' => 1,
                'rota_meta_id' => 1,
                'date' => '2022-09-26',
                'start_time' => '12:00:00',
                'end_time' => '13:00:00',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'shop_id' => 1,
                'rota_id' => 1,
                'rota_meta_id' => 1,
                'date' => '2022-09-26',
                'start_time' => '15:00:00',
                'end_time' => '16:00:00',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ]);
    }
}
