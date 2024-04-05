<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Type;
use Illuminate\Http\Response;

class TypeController extends Controller
{
    // Visualizza tutte le tipologie di ristoranti
    public function index(){
        $types = Type::all()->map(function ($type) {
            // Aggiunge l'URL completo all'icona prima di restituire i dati
            $type->icon = asset('storage/icons/' . $type->icon);
            return $type;
        });
    
        return response()->json([
            'success' => true,
            'results' => $types,
        ]);
    }
}