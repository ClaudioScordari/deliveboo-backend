<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Models
use App\Models\Restaurant;
use App\Models\Type;
use App\Models\User;

// Request
use App\Http\Requests\StoreRestaurantRequest;
use App\Http\Requests\UpdateRestaurantRequest;

// Facades
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Prendo il ristorate associato a quell'id
        $restaurants = Restaurant::where('user_id', Auth::id())->get();

        return view('admin.restaurants.index', compact('restaurants'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Restaurant $restaurant)
    {
        return view('admin.restaurants.show', compact('restaurant'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::all();

        return view('admin.restaurants.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRestaurantRequest $request)
    {   
        $user = Auth::user(); // Ottieni l'utente autenticato

        // Controlla se l'utente ha già un ristorante
        if ($user->restaurant) {
            // Reindirizza con un messaggio di errore
            return redirect()->back()->with('error', 'Hai già un ristorante associato al tuo account.');
        }
        
        // Prendere dati validati
        $validDatas = $request->validated();

        // Settare img a null se l'image nella colonna dell'istanza non c'è
        $imgPath = null;

        // Se l'input del file è pieno, riempio il percorso
        if (isset($validDatas['img'])) {
            // Assegno il percorso
            $imgPath = Storage::disk('public')->put('image', $validDatas['img']);
        }

        // Creazione dell'istanza restaurant
        $restaurant = Restaurant::create([
            'user_id' => Auth::id(), // Ottieni l'ID dell'utente autenticato
            'activity_name' => $validDatas['activity_name'],
            'VAT_number' => $validDatas['VAT_number'],
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

        return redirect()->route('admin.restaurants.index', compact('restaurant'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Restaurant $restaurant)
    {
        $types = Type::all();

        return view('admin.restaurants.edit', compact('restaurant', 'types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRestaurantRequest $request, Restaurant $restaurant)
    {
        // Prendo i dati validati
        $validDatas = $request->validated();

        // Setto il percorso dell'img con quello originale, anche se era null
        $imgPath = $restaurant->image;

        // Se l'input del file è pieno...
        if (isset($validDatas['img'])) {

            // Controllo se l'img dell'istanza è piena...
            if ($restaurant->image != null) {
                // Elimino il percorso corrente
                Storage::disk('public')->delete($restaurant->image);
            }

            // E setto il nuovo percorso
            $imgPath = Storage::disk('public')->put('image', $validDatas['img']);
        }
        // Altrimenti se è vuoto (l'input), e megari mi spunta la checkbox (remove_file), vuole eliminare l'img 
        else if (isset($validDatas['remove_file'])) {

            // elimino il percorso
            Storage::disk('public')->delete($restaurant->image);
            
            // Mi riempio la var del percorso a null 
            $imgPath = null;
        }
        
        // Faccio update della nuova istanza di restaurant
        $restaurant->update([
            'activity_name' => $validDatas['activity_name'],
            'VAT_number' => $validDatas['VAT_number'],
            'address' => $validDatas['address'],
            'image' => $imgPath,
            'description' => $validDatas['description'],
        ]);

        // Se l'array dei tipi è pieno
        if (isset($validDatas['types'])) {
            // Faccio la sincronizzazione con il nuovo array
            $restaurant->types()->sync($validDatas['types']);
        } 
        else {
            // Altrimenti tolgo i tipi dall'istanza
            $restaurant->types()->detach();
        }

        return redirect()->route('admin.restaurants.show', compact('restaurant'));
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Restaurant $restaurant)
    {
        // E poi elimino il progetto
        $restaurant->delete();

        return redirect()->route('admin.dashboard');
    }
}