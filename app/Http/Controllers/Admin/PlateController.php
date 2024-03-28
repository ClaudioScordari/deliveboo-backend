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

        $plate = Plate::create([
            'restaurant_id' => auth()->user()->restaurant->id,
            'name' => $validDatas['name'],
            'price' => $validDatas['price'],
            'address' => $validDatas['address'],
            'image' => $imgPath,
            'description' => $validDatas['description'],
        ]);

        // Se l'array dei tipi è pieno, scorrere array delle checkbox per creare associazioni
        if (isset($validDatas['types'])) {

            // Scorro l'array delle checkbox e creo associazione con la nuova istanza di restaurant
            foreach ($validDatas['types'] as $oneTypeId) {
                $restaurant->types()->attach($oneTypeId);
            }
        }

        return redirect()->route('admin.restaurants.show', compact('restaurant'));
    }
}
