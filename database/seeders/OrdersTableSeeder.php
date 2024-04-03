<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $orders = config('orders');
        
        foreach ($orders as $order) {

            $randomCreatedAt = Carbon::now()->subDays(rand(0, 365));
            $randomPrice = rand(1000, 15000) / 100;

            $orderId = DB::table('orders')->insertGetId([
                //'restaurant_id' => $order['restaurant_id'],
                'payment_status' => $order['payment_status'],
                'total_price' => $randomPrice,
                'name' => $order['name'],
                'phone' => $order['phone'],
                'address' => $order['address'],
                'notes' => $order['notes'],
                'created_at' => $randomCreatedAt,
                'updated_at' => Carbon::now(), 
            ]);

            // Per ogni ordine, aggiungi piatti coerenti con il ristorante
            // DB::table('plates')->where('restaurant_id', $order['restaurant_id'])->pluck('id');
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
