<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderPlateTableSeeder extends Seeder

{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $orders = DB::table('orders')->pluck('id');
        $plates = DB::table('plates')->pluck('id');

        foreach ($orders as $orderId) {
            // Decide on the number of plates per order
            $platesToAttach = $plates->random(rand(1, 5))->unique();

            foreach ($platesToAttach as $plateId) {
                // Assign a random quantity for each plate, e.g., between 1 and 4
                $quantity = rand(1, 4);

                DB::table('order_plate')->insert([
                    'order_id' => $orderId,
                    'plate_id' => $plateId,
                    'quantity' => $quantity,
                ]);
            }
        }
    }
}
