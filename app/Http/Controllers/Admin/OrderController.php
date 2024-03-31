<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Models
use App\Models\Order;

// Request
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;

// Facades
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    // Ottiene l'ID del ristorante dell'utente autenticato
    $restaurantId = auth()->user()->restaurant->id;

    // Ottiene gli ordini che appartengono al ristorante dell'utente autenticato
    $orders = Order::where('restaurant_id', $restaurantId)->with('plates')->get();

        return view('admin.orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with('plates')->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }
    
    public function getStatistics()
    {
        // Ottiene l'ID del ristorante dell'utente autenticato
        $restaurantId = auth()->user()->restaurant->id;
    
        // Numero di ordini per il ristorante
        $ordersCount = Order::where('restaurant_id', $restaurantId)->count();
        
        // Totale piatti ordinati per il ristorante
        $totalPlates = DB::table('order_plate')
                        ->join('orders', 'orders.id', '=', 'order_plate.order_id')
                        ->where('orders.restaurant_id', $restaurantId)
                        ->sum('order_plate.quantity');

        // Piatti più ordinati per il ristorante
        $popularPlates = DB::table('plates')
                        ->join('order_plate', 'plates.id', '=', 'order_plate.plate_id')
                        ->join('orders', 'orders.id', '=', 'order_plate.order_id')
                        ->select('plates.name', DB::raw('count(order_plate.plate_id) as orders_count'))
                        ->where('orders.restaurant_id', $restaurantId) // Filtra per il ristorante
                        ->groupBy('plates.name')
                        ->orderBy('orders_count', 'desc')
                        //->take(5) // Prendi i primi 5 piatti più ordinati
                        ->get();
 
        $labels = $popularPlates->pluck('name');
        $data = $popularPlates->pluck('orders_count');


        // Totale soldi guadagnati per il ristorante
        $totalRevenue = Order::where('restaurant_id', $restaurantId)->sum('total_price');
        
        return view('admin.stats.index', compact('ordersCount', 'totalPlates', 'totalRevenue', 'labels', 'data'));
    }

}
