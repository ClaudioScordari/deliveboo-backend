<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Models
use App\Models\Restaurant;
class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $restaurants = config('restaurants');

        return view('admin.restaurants.index', compact('restaurants'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Restaurant $restaurant)
    {
        /*
            Qui da prendere istanze dei ristoranti.
            Dati per adesso da un array associativo
        */

        return view('admin.restaurants.show', compact('restaurant'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        /*
            Qui passare tutti i tipi 
            per costruire il ristorante
        */

        return view('admin.restaurants.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Prendere dati validati

        // Settare img a null se l'img nella colonna dell'istanza non c'è

        // Ambito img - se l'input del file è pieno, riempio il percorso

        // Creazione dell'istanza restaurant

        // Se l'array dei tipi è pieno, scorrere array delle checkbox per creare associazioni

        // Restituzione dello show
        return redirect()->route('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Restaurant $restaurant)
    {
        return view('admin.restaurants.edit', compact('restaurant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Restaurant $restaurant)
    {
        // Prendo i dati validati

        // Setto il percorso dell'img con quello originale, anche se era null

        // Se l'input è pieno...

            // Controllo se l'img dell'istanza è piena...

                // Elimino il percorso corrente
            
            // Setto il nuovo percorso dell'img

        // Altrimenti se è vuoto (l'input), e megari mi spunta la checkbox, vuole eliminare l'img 

            // elimino il percorso
            
            // mi riempio la var del percorso a null
        
        // Faccio update della nuova istanza di restaurant

        // Se l'array dei tipi è pieno
            
            // faccio la sincronizzazione con il nuovo array

            // altrimenti tolgo i tipi dall'istanza con il detach

        return redirect()->route('admin.restaurant.show', compact('restaurant'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Restaurant $restaurant)
    {
        /*
            Se elimino il ristorante:
            devo controllare se ha img associate, quindi
            svuotare la riga della sua img se è piena
        */

        // e poi elimino il progetto

        return redirect()->route('admin.restaurants.index');
    }
}




