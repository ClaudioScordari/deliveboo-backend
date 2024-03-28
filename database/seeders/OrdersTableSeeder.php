<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $orders = config('orders');
        
        foreach ($orders as $order) {
            $orderId = DB::table('orders')->insertGetId([
                'restaurant_id' => $order['restaurant_id'],
                'payment_status' => $order['payment_status'],
                'total_price' => $order['total_price'],
                'name' => $order['name'],
                'phone' => $order['phone'],
                'address' => $order['address'],
                'notes' => $order['notes'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Per ogni ordine, aggiungi piatti coerenti con il ristorante
            $restaurantPlates = DB::table('plates')->where('restaurant_id', $order['restaurant_id'])->pluck('id');
            foreach ($order['plates'] as $plate) {
                DB::table('order_plate')->insert([
                    'order_id' => $orderId,
                    'plate_id' => $plate['plate_id'],
                    'quantity' => $plate['quantity'],
                ]);
            }
        }
    }
}
