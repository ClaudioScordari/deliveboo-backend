<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RestaurantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $restaurants = config('restaurants');
        
        foreach ($restaurants as $restaurant) {
            DB::table('restaurants')->insert([
                'user_id' => $restaurant['user_id'],
                'activity_name' => $restaurant['activity_name'],
                'VAT_number' => $restaurant['VAT_number'],
                'address' => $restaurant['address'],
                'image' => $restaurant['image'],
                'description' => $restaurant['description'],
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
