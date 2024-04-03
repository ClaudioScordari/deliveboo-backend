<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UpdateOrderTotalPriceSeeder extends Seeder
{
    public function run()
    {
        $orders = DB::table('orders')->get();

        foreach ($orders as $order) {
            $orderPlates = DB::table('order_plate')->where('order_id', $order->id)->get();
            $totalPrice = 0;

            foreach ($orderPlates as $orderPlate) {
                $plate = DB::table('plates')->where('id', $orderPlate->plate_id)->first();
                if ($plate) {
                    $totalPrice += $plate->price * $orderPlate->quantity;
                }
            }

            // Aggiorna l'ordine con il total_price calcolato
            DB::table('orders')->where('id', $order->id)->update(['total_price' => $totalPrice]);
        }
    }
}