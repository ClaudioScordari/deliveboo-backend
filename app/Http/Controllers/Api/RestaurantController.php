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
        $restaurants = Restaurant::with(['types', 'plates'])->paginate(10);
    
        // Trasforma i ristoranti dopo la paginazione
        foreach ($restaurants as $restaurant) {
            $restaurant->image = $restaurant->image ? asset('storage/' . $restaurant->image) : null;
            foreach ($restaurant->plates as $plate) {
                $plate->image = $plate->image ? asset('storage/' . $plate->image) : null;
            }
        }
    
        return response()->json([
            'success' => true,
            'results' => $restaurants,
        ]);
    }

    public function show(Restaurant $restaurant)
    {
        $restaurant->image = $restaurant->image ? asset('storage/' . $restaurant->image) : null;
        
        foreach ($restaurant->plates as $plate) {
            $plate->image = $plate->image ? asset('storage/' . $plate->image) : null;
        }

        return response()->json([
            'success' => true,
            'results' => $restaurant,
        ]);
    }

    public function getRestaurantByType($typeId)
    {
        $type = Type::findOrFail($typeId);
        $restaurants = $type->restaurants->map(function ($restaurant) {
            $restaurant->image = $restaurant->image ? asset('storage/' . $restaurant->image) : null;
            return $restaurant;
        });

        return response()->json([
            'success' => true,
            'results' => $restaurants,
        ]);
    }

    public function search($name)
    {
        $restaurants = Restaurant::where('activity_name', 'like', "%" . $name . "%")->with(['types', 'plates'])->get()->map(function ($restaurant) {
            $restaurant->image = $restaurant->image ? asset('storage/' . $restaurant->image) : null;
            $restaurant->plates = $restaurant->plates->map(function ($plate) {
                $plate->image = $plate->image ? asset('storage/' . $plate->image) : null;
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
