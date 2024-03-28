<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Models
use App\Models\Plate;

class PlateController extends Controller
{
    public function index()
    {
        // Ottiene l'ID del ristorante dell'utente autenticato
        $restaurantId = auth()->user()->restaurant->id;
        
        $plates = Plate::where('restaurant_id', $restaurantId)->get();
        return view('admin.plates.index', compact('plates'));
    }
    
}
