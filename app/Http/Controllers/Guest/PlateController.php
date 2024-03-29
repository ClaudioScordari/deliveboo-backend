<?php

namespace App\Http\Controllers\Guest;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;

use App\Models\Plate;

class PlateController extends Controller
{
    public function index()
    {
        
        $plates = Plate::all();
        return view('guest.plates.index', compact('plates'));
    }

    public function show(Plate $plate)
    {
        return view('guest.plates.show', compact('plate'));
    }
}