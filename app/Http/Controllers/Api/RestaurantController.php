<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Response;

class RestaurantController extends Controller
{
    // Visualizza tutti i ristoranti
    public function index()
    {
        $restaurants = Restaurant::all();
        return response()->json($restaurants);
    }

    // Visualizza i dettagli di un singolo ristorante
    public function show(Restaurant $restaurant)
    {
        return response()->json($restaurant);
    }
}