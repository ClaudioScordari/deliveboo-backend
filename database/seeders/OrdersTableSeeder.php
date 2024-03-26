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
            DB::table('orders')->insert([
                'payment_status' => $order['payment_status'],
                'total_price' => $order['total_price'],
                'name' => $order['name'],
                'phone' => $order['phone'],
                'address' => $order['address'],
                'notes' => $order['notes'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
