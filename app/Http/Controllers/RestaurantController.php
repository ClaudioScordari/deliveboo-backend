<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Models
use App\Models\Restaurant;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $restaurants = config('restaurants');

        return view('restaurants.index', compact('restaurants'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Restaurant $restaurant)
    {
        /*
            Qui da prendere istanze dei ristoranti.
            Dati per adesso da un array associativo
        */

        return view('restaurants.show', compact('restaurant'));
    }
}
