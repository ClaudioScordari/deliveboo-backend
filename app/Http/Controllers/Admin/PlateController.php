<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Models
use App\Models\Plate;
use App\Models\Restaurant;

// Request
use App\Http\Requests\StorePlateRequest;
use App\Http\Requests\UpdatePlateRequest;

// Facades
use Illuminate\Support\Facades\Storage;

class PlateController extends Controller
{
    public function index()
    {
        // Ottiene l'ID del ristorante dell'utente autenticato
        $restaurantId = auth()->user()->restaurant->id;
        
        $plates = Plate::where('restaurant_id', $restaurantId)->get();
        return view('admin.plates.index', compact('plates'));
    }

    public function show(Plate $plate)
    {
        return view('admin.plates.show', compact('plate'));
    }

    public function create()
    {
        return view('admin.plates.create');
    }

    public function store(StorePlateRequest $request)
    {
        $validDatas = $request->validated();

        $imgPath = null;

        if (isset($validDatas['img'])) {
            $imgPath = Storage::disk('public')->put('image', $validDatas['img']);
        }

        // Se è piena la spunta visible
        if (isset($validDatas['visible'])) {

            // Mi riempio la colonna visible 
            $visible = $validDatas['visible'];
        } else {
            $visible = 0;
        } 

        $plate = Plate::create([
            'restaurant_id' => auth()->user()->restaurant->id,
            'name' => $validDatas['name'],
            'price' => $validDatas['price'],
            'visible' => $visible,
            'ingredients' => $validDatas['ingredients'],
            'image' => $imgPath,
            'description' => $validDatas['description'],
        ]);

        return redirect()->route('admin.plates.show', compact('plate'));
    }

    public function edit(Plate $plate)
    {
        return view('admin.plates.edit', compact('plate'));
    }
}
