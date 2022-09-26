<?php

namespace Database\Seeders;

use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Service::insert([
           [
               'name' => 'Haircut',
               'price' => '$50',
               'created_at' => Carbon::now(),
               'updated_at' => Carbon::now()
           ],
            [
                'name' => 'Hair Coloring',
                'price' => '$100',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ]);
    }
}
