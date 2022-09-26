<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call([
            ShopSeeder::class,
            UserTypeSeeder::class,
            UserSeeder::class,
            ConfigurationSeeder::class,
            RotaSeeder::class,
            RotaMetaSeeder::class,
            BreakSeeder::class,
            ServiceSeeder::class,
            AppointmentSeeder::class
        ]);

        // \App\Models\User::factory(10)->create();
    }
}
