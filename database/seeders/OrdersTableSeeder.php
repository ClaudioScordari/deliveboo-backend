<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class OrdersTableSeeder extends Seeder
{
    public function run()
    {
        $orders = config('orders');

        foreach ($orders as $orderConfig) {
            $randomCreatedAt = Carbon::now()->subDays(rand(0, 365));

            // Inserisci l'ordine senza il prezzo totale
            $orderId = DB::table('orders')->insertGetId([
                'payment_status' => $orderConfig['payment_status'],
                'total_price' => 0, // Impostato temporaneamente a 0
                'name' => $orderConfig['name'],
                'phone' => $orderConfig['phone'],
                'address' => $orderConfig['address'],
                'notes' => $orderConfig['notes'],
                'created_at' => $randomCreatedAt,
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}