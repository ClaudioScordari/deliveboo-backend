<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Type;
use App\Models\Plate;

class RestaurantController extends Controller
{
    public function index()
    {
        $restaurants = Restaurant::with(['types', 'plates'])->get();
    
        foreach ($restaurants as $restaurant) {
            $restaurant->image = $restaurant->image ? asset('storage/' . $restaurant->image) : asset('storage/restaurant-not-found.png'); // Fornisci un'immagine di default
            foreach ($restaurant->plates as $plate) {
                $plate->image = $plate->image ? asset('storage/' . $plate->image) : asset('storage/plate-not-found.png'); // Fornisci un'immagine di default per i piatti
            }
        }
    
        return response()->json([
            'success' => true,
            'results' => $restaurants,
        ]);
    }

    public function show(Restaurant $restaurant)
    {
        $restaurant->image = $restaurant->image ? asset('storage/' . $restaurant->image) : asset('storage/restaurant-not-found.png'); // Fornisci un'immagine di default

        foreach ($restaurant->plates as $plate) {
            $plate->image = $plate->image ? asset('storage/' . $plate->image) : asset('storage/plate-not-found.png'); // Fornisci un'immagine di default per i piatti
        }

        return response()->json([
            'success' => true,
            'results' => $restaurant,
        ]);
    }

    public function getRestaurantByType(Request $request)
    {
        // Ottenere gli id dei tipi dalla richiesta
        $typesId = $request->query('typesId');

        // Converto l'elenco degli id dei tipi in un array
        $typesIdArray = explode(',', $typesId);

        // Inizializzare una collezione vuota per i ristoranti
        $restaurants = collect();

        // Iterare su ogni id tipo
        foreach ($typesIdArray as $typeId) {
            // Trova il tipo corrispondente all'id
            $type = Type::findOrFail($typeId);

            // Recupera i ristoranti associati al tipo corrente e uniscili alla collezione dei ristoranti
            $typeRestaurants = $type->restaurants()->get();
            $restaurants = $restaurants->merge($typeRestaurants);
        }

        // Rimuovere eventuali duplicati di ristoranti
        $restaurants = $restaurants->unique();

        // Trasformiamo la collezione dei risultati per includere l'URL dell'immagine se disponibile
        $restaurants->getCollection()->transform(function ($restaurant) {
            $restaurant->image = $restaurant->image ? asset('storage/' . $restaurant->image) : asset('storage/restaurant-not-found.png'); // Fornisci un'immagine di default
            return $restaurant;
        });

        // Restituire i risultati come JSON
        return response()->json([
            'success' => true,
            'results' => $restaurants,
        ]);
    }

    public function search($name)
    {
        $restaurants = Restaurant::where('activity_name', 'like', "%" . $name . "%")->with(['types', 'plates'])->get()->map(function ($restaurant) {
            $restaurant->image = $restaurant->image ? asset('storage/' . $restaurant->image) : asset('storage/restaurant-not-found.png'); // Fornisci un'immagine di default
            $restaurant->plates = $restaurant->plates->map(function ($plate) {
                $plate->image = $plate->image ? asset('storage/' . $plate->image) : asset('storage/plate-not-found.png'); // Fornisci un'immagine di default per i piatti
                return $plate;
            });
            return $restaurant;
        });

        return response()->json([
            'success' => true,
            'results' => $restaurants,
        ]);
    }

    // public function getDetailRestaurant($id){
    //     $restaurant = Restaurant::where('id', $id)->with('types', 'types')->first();
    //     if($restaurant->image) $restaurant->image = asset('storage/' . $restaurant->image) ;
    //         else{
    //             $restaurant->image = asset('storage/not-found.png') ;
    //         }

    //     return response()->json($restaurant);
    //   }
}
