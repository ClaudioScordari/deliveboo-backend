<?php

namespace App\Http\Controllers\Guest;

use App\Models\Restaurants;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;

use App\Models\Restaurant;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    { 
        $restaurants = Restaurant::all();

        return view('guest.restaurants.index', compact('restaurants'));
        
    }
    
    /**
     * Display the specified resource.
     */
    public function show(Restaurant $restaurant)
    {
        return view('guest.restaurants.show', compact('restaurants'));
    }


}