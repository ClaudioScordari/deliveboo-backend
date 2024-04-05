<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Plate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PlateController extends Controller
{
    public function index(){
        $plates = Plate::all()->map(function ($plate) {
            // Aggiunge l'URL completo all'immagine prima di restituire i dati
            $plate->image = asset('storage/' . $plate->image);
            return $plate;
        });
    
        return response()->json([
            'success' => true,
            'results' => $plates,
        ]);
    }

    // Visualizza i piatti di un singolo ristorante
    public function restaurantPlates($restaurant)
    {
        $plates = Plate::where('restaurant_id', $restaurant)->get()->map(function ($plate) {
            // Aggiunge l'URL completo all'immagine prima di restituire i dati
            $plate->image = asset('storage/' . $plate->image);
            return $plate;
        });

        return response()->json([
            'success' => true,
            'results' => $plates
        ]);
    }

    public function search($name)
    {
        $plates = Plate::where('name', 'like', "%" . $name . "%")->with('restaurant')->get()->map(function ($plate) {
            // Aggiunge l'URL completo all'immagine prima di restituire i dati
            $plate->image = asset('storage/' . $plate->image);
            return $plate;
        });

        return response()->json([
            'success' => true,
            'results' => $plates,
        ]);
    }
}