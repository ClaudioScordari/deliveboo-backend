<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Plate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PlateController extends Controller
{
    // Visualizza i piatti di un singolo ristorante
    public function showByRestaurant($restaurant)
    {
        $plates = Plate::where('restaurant_id', $restaurant)->get();
        return response()->json($plates);
    }
}