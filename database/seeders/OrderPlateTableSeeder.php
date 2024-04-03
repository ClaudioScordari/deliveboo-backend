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
        $orders = DB::table('orders')->get(); // Recupera tutti gli ordini

        foreach ($orders as $order) {
            // Per ogni ordine, selezioniamo un ristorante casualmente dai piatti disponibili
            // Assumendo che ogni ordine possa avere piatti solo da un unico ristorante
            $plates = DB::table('plates')->get(); // Recupera tutti i piatti
            $platesGroupedByRestaurant = $plates->groupBy('restaurant_id'); // Raggruppa i piatti per ristorante
            
            // Seleziona un gruppo di piatti di un ristorante casualmente
            $selectedPlatesGroup = $platesGroupedByRestaurant->random();
            
            // Ottieni ID dei piatti dal gruppo selezionato
            $selectedPlateIds = $selectedPlatesGroup->pluck('id');
            
            // Seleziona un numero casuale di piatti da questo gruppo
            $platesToAttach = $selectedPlateIds->random(rand(1, $selectedPlateIds->count()))->all();

            foreach ($platesToAttach as $plateId) {
                // Assegna una quantità casuale per ogni piatto selezionato
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
