<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Models
use App\Models\Order;
use App\Models\Plate;

// Request
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;

// Facades
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ottiene l'ID del ristorante dell'utente autenticato
        $restaurantId = auth()->user()->restaurant->id;
    
        // Ottiene gli ID dei piatti che appartengono al ristorante dell'utente autenticato
        $plateIds = Plate::where('restaurant_id', $restaurantId)->pluck('id');
    
        // Ottiene gli ordini basati sui piatti che appartengono al ristorante dell'utente autenticato
        $orders = Order::whereHas('plates', function ($query) use ($plateIds) {
            $query->whereIn('plates.id', $plateIds);
        })->with('plates')->get();
    
        return view('admin.orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with('plates')->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    public function edit($id)
    {
        $order = Order::findOrFail($id);

        // Restituisci la vista con l'ordine da modificare
        return view('admin.orders.edit', compact('order'));
    }

    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        
        $validatedData = $request->validate([
            'payment_status' => 'required|in:Completato,In Attesa,Fallito',
        ]);
        
        // Aggiornamento dello stato dell'ordine
        $order->update([
            'payment_status' => $validatedData['payment_status'],
        ]);
        
        return redirect()->route('admin.orders.index');
    }
    
    public function getStatistics()
    {
        // Ottiene l'ID del ristorante dell'utente autenticato
        $restaurantId = auth()->user()->restaurant->id;

        // Ottiene gli ID dei piatti che appartengono al ristorante dell'utente autenticato
        $plateIds = Plate::where('restaurant_id', $restaurantId)->pluck('id')->toArray();

        // Numero di ordini che includono almeno un piatto del ristorante dell'utente autenticato
        $ordersCount = Order::whereHas('plates', function ($query) use ($plateIds) {
            // Assicura che l'ordine includa almeno uno dei piatti del ristorante specifico
            $query->whereIn('plate_id', $plateIds);
        })->count(); // Usa 'distinct()' per assicurarti di contare ogni ordine una sola volta
    
        // Totale piatti ordinati e Piatti più ordinati per il ristorante
        $totalPlates = 0;
        $popularPlates = [];
    
        foreach ($plateIds as $plateId) {
            $ordersForPlate = Order::whereHas('plates', function ($query) use ($plateId) {
                $query->where('plates.id', $plateId);
            })->get();
    
            $totalPlates += $ordersForPlate->sum(function ($order) use ($plateId) {
                return $order->plates->where('id', $plateId)->first()->pivot->quantity;
            });
    
            $popularPlates[$plateId] = $ordersForPlate->count();
        }
    
        return view('admin.stats.index', compact('ordersCount', 'totalPlates'));
    }
    
}
