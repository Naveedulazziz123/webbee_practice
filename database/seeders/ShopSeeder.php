<?php

namespace Database\Seeders;

use App\Models\Shop;
use Carbon\Carbon;
use Illuminate\Database\Seeder;


class ShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Shop::insert(
            [
                'name' => 'Webbee Hair Cut',
                'owner_name' => 'Tobias',
                'email' => 'tobias@gmail.com',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        );
    }
}
