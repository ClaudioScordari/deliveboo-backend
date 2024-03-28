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
        $orders = DB::table('orders')->get(); // Recupera tutti gli ordini con i loro dettagli

        foreach ($orders as $order) {
            // Recupera i piatti per il ristorante specifico dell'ordine
            $plates = DB::table('plates')
                        ->where('restaurant_id', $order->restaurant_id)
                        ->pluck('id');

            // Decidi il numero di piatti per ordine
            $platesToAttach = $plates->random(rand(1, 5))->unique();

            foreach ($platesToAttach as $plateId) {
                // Assegna una quantità casuale per ogni piatto, es. tra 1 e 4
                $quantity = rand(1, 4);

                // Inserisci la relazione nella tabella pivot
                DB::table('order_plate')->insert([
                    'order_id' => $order->id,
                    'plate_id' => $plateId,
                    'quantity' => $quantity,
                ]);
            }
        }
    }
}
