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

    public function show($id)
    {
        $plate = Plate::findOrFail($id);

        // Verifica se l'utente attuale è il proprietario del ristorante a cui appartiene il piatto
        if ($plate->restaurant->user_id !== auth()->id()) {
            // Se non è il proprietario, reindirizza con un messaggio di errore
            return redirect()->route('admin.restaurants.index')->with('error', 'Non sei autorizzato a visualizzare questa risorsa.');
        }

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

    public function edit($id)
    {       
        $plate = Plate::findOrFail($id);

        // Verifica se l'utente attuale è il proprietario del ristorante a cui appartiene il piatto
        if ($plate->restaurant->user_id !== auth()->id()) {
            // Se non è il proprietario, reindirizza con un messaggio di errore
            return redirect()->route('admin.dashboard')->with('error', 'Non sei autorizzato a visualizzare questa risorsa.');
        }

        return view('admin.plates.edit', compact('plate'));
    }

    public function update(UpdatePlateRequest $request, Plate $plate)
    {
        $validDatas = $request->validated();

        $imgPath = $plate->image;

        if (isset($validDatas['img'])) {
            if ($plate->image != null) {
                Storage::disk('public')->delete($plate->image);
            }

            $imgPath = Storage::disk('public')->put('image', $validDatas['img']);
        }
        else if (isset($validDatas['remove_file'])) {

            Storage::disk('public')->delete($plate->image);
                
            $imgPath = null;
        }

        if (isset($validDatas['visible'])) {
            $visible = $validDatas['visible'];
        } else {
            $visible = 0;
        } 
            
        $plate->update([
            'name' => $validDatas['name'],
            'description' => $validDatas['description'],
            'price' => $validDatas['price'],
            'visible' => $visible,
            'ingredients' => $validDatas['ingredients'],
            'image' => $imgPath,
        ]);

        return redirect()->route('admin.plates.show', compact('plate'));
    }

    public function destroy(Plate $plate)
    {
        $plate->delete();

        return redirect()->route('admin.plates.index');
    }
}

