<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Models
use App\Models\Plate;
use App\Models\Restaurant;

class PlateController extends Controller
{
    public function index(Restaurant $restaurant)
    {
        $plates = Plate::where('restaurant_id', $restaurant->id)->get();

        return view('admin.plates.index', compact('plates', 'restaurant'));
    }
}
