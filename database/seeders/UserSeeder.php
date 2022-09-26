<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            [
                'first_name' => 'Tobias',
                'last_name' => null,
                'email' => 'tobias@gmail.com',
                'user_type_id' => 1,
                'shop_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'first_name' => 'Naveed',
                'last_name' => 'Aziz',
                'email' => 'naveed@gmail.com',
                'user_type_id' => 2,
                'shop_id' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ]);
    }
}
