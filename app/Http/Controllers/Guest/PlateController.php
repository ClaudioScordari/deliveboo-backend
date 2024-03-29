<?php

namespace App\Http\Controllers\Guest;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;

use App\Models\Restaurant;
use App\Models\Plate;

class PlateController extends Controller
{
    public function index($restaurantId)
    {
        $plates = Plate::where('restaurant_id', $restaurantId)->get();
        return view('guest.plates.index', compact('plates'));
    }

    public function show(Plate $plate)
    {
        $restaurant = $plate->restaurant;

        return view('guest.plates.show', compact('plate', 'restaurant'));
    }
}