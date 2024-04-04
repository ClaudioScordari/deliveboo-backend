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

    public function getMonthlyOrdersStatistics($restaurantId)
    {
        $months = [];
        $ordersCount = [];
        $revenuePerMonth = [];
    
        for ($i = 11; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $monthName = $date->format('F');
            $year = $date->format('Y');
    
            $orders = DB::table('orders')
                        ->join('order_plate', 'orders.id', '=', 'order_plate.order_id')
                        ->join('plates', 'order_plate.plate_id', '=', 'plates.id')
                        ->where('plates.restaurant_id', $restaurantId)
                        ->whereYear('orders.created_at', $year)
                        ->whereMonth('orders.created_at', $date->month)
                        ->select(DB::raw('count(distinct orders.id) as orderCount'), DB::raw('sum(total_price) as revenue'))
                        ->first();
    
            $months[] = $monthName;
            $ordersCount[] = $orders->orderCount;
            $revenuePerMonth[] = $orders->revenue;
        }
    
        return ['months' => $months, 'ordersCount' => $ordersCount, 'revenuePerMonth' => $revenuePerMonth];
    }

    public function showMonthlyStatistics()
    {
        $user = auth()->user();
        if (!$user->restaurant) {
            return redirect()->route('admin.dashboard')->withErrors('Non hai un ristorante associato al tuo account.');
        }

        $restaurantId = $user->restaurant->id;
        $statistics = $this->getMonthlyOrdersStatistics($restaurantId);

        $totalOrders = Order::whereHas('plates', function($query) use ($restaurantId) {
            $query->where('restaurant_id', $restaurantId);
        })->count();

        $totalRevenue = Order::whereHas('plates', function($query) use ($restaurantId) {
            $query->where('restaurant_id', $restaurantId);
        })->sum('total_price');

        return view('admin.stats.index', compact('statistics', 'totalOrders', 'totalRevenue'));
    }

}