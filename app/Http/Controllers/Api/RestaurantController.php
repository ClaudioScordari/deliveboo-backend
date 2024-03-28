<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Restaurant;

use Illuminate\Support\Facades\Auth;

class RestaurantController extends Controller
{
    public function index()
    {
        // Prendo il ristorate associato a quell'id
        $restaurants = Restaurant::where('user_id', Auth::id())->get();

        return response()->json($restaurants);
    }
}