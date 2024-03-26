<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Retrieve the dishes array from the configuration
        $plates = config('plates');

        foreach ($plates as $plate) {
            DB::table('plates')->insert([
                'restaurant_id' => $plate['restaurant_id'],
                'name' => $plate['name'],
                'description' => $plate['description'],
                'price' => $plate['price'],
                'visible' => $plate['visible'],
                'ingredients' => $plate['ingredients'],
                'image' => $plate['image'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
