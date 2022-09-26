<?php

namespace Database\Seeders;

use App\Models\Configuration;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ConfigurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Configuration::insert([
            [
                'name' => 'no of person',
                'data' => '3',
                'slug' => 'no_of_person',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'buffer time',
                'data' => '10',
                'slug' => 'buffer_time',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ]);
    }
}
