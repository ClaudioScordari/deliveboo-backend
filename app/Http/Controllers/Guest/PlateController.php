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
        return view('admin.plates.index', compact('plates'));
    }

    public function show(Plate $plate)
    {
        return view('admin.plates.show', compact('plate'));
    }
}