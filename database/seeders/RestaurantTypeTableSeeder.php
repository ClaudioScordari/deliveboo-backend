<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RestaurantTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $restaurants = DB::table('restaurants')->pluck('id');
        $types = DB::table('types')->pluck('id');

        foreach ($restaurants as $restaurantId) {
            // Each restaurant will have between 1 and 3 types randomly
            $typesToAttach = $types->random(rand(1, 3));
            foreach ($typesToAttach as $typeId) {
                DB::table('restaurant_type')->insert([
                    'restaurant_id' => $restaurantId,
                    'type_id' => $typeId,
                ]);
            }
        }
    }
}
