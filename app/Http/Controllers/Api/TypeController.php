<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Type;
use Illuminate\Http\Response;

class TypeController extends Controller
{
    // Visualizza tutte le tipologie di ristoranti
    public function index()
    {
        $types = Type::all();
        return response()->json($types);
    }
}