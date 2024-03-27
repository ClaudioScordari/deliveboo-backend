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
        $associations = config('restaurantTypes');

        foreach ($associations as $association) {
            foreach ($association['type_ids'] as $typeId) {
                DB::table('restaurant_type')->insert([
                    'restaurant_id' => $association['restaurant_id'],
                    'type_id' => $typeId,
                ]);
            }
        }
    }
}
