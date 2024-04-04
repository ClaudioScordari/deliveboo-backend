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
        })->with('plates')->orderBy('created_at', 'desc')->get();
    
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
    
        for ($i = 12; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $monthName = $date->format('F Y');
            $year = $date->format('Y');
    
            $orders = DB::table('orders')
                        ->join('order_plate', 'orders.id', '=', 'order_plate.order_id')
                        ->join('plates', 'order_plate.plate_id', '=', 'plates.id')
                        ->where('plates.restaurant_id', $restaurantId)
                        ->whereYear('orders.created_at', $year)
                        ->whereMonth('orders.created_at', $date->month)
                        ->select(DB::raw('count(distinct orders.id) as orderCount'), DB::raw('sum(total_price) as revenue'))
                        ->first();

             // Calcola la somma dei total_price per il mese corrente
            $monthlyRevenue = Order::whereHas('plates', function ($query) use ($restaurantId) {
                $query->where('plates.restaurant_id', $restaurantId);
            })->whereYear('created_at', $year)
            ->whereMonth('created_at', $date->month)
            ->sum('total_price');
    
            $months[] = $monthName;
            $ordersCount[] = $orders->orderCount;
            $revenuePerMonth[] = $monthlyRevenue;
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

        // Preparazione delle etichette per gli ultimi 30 giorni
        $labels = collect(new \DatePeriod(
            Carbon::now()->subDays(29),
            new \DateInterval('P1D'),
            Carbon::now()
        ))->map(function ($date) {
            return Carbon::instance($date)->format('Y-m-d');
        });

        // Ottiene il conteggio degli ordini per ogni giorno per il ristorante specifico
        $today = Carbon::today();
        $thirtyDaysAgo = $today->copy()->subDays(29);
        
        // Crea un array per le etichette e uno per i conteggi degli ordini
        $labels = [];
        $ordersCountPerDay = [];
        $revenuePerDay = [];
        
        // Popola gli array con i dati per ogni giorno degli ultimi 30 giorni
        for ($date = $thirtyDaysAgo; $date->lte($today); $date->addDay()) {
            $formattedDate = $date->format('d M');
            $labels[] = $formattedDate;
        
            // Calcola il conteggio degli ordini per quella data
            $orderCount = Order::whereDate('created_at', $date)
                                ->whereHas('plates', function ($query) use ($restaurantId) {
                                    $query->where('plates.restaurant_id', $restaurantId);
                                })
                                ->count();
        
            $ordersCountPerDay[] = $orderCount;

            // Calcola i guadagni per quella data
            $dailyRevenue = Order::whereDate('created_at', $date)
                                ->whereHas('plates', function ($query) use ($restaurantId) {
                                    $query->where('plates.restaurant_id', $restaurantId);
                                })
                                ->sum('total_price');
            
            $revenuePerDay[] = $dailyRevenue;
        }

        $totalOrders = Order::whereHas('plates', function($query) use ($restaurantId) {
            $query->where('restaurant_id', $restaurantId);
        })->count();

        $totalRevenue = Order::whereHas('plates', function($query) use ($restaurantId) {
            $query->where('restaurant_id', $restaurantId);
        })->sum('total_price');

        return view('admin.stats.index', compact('statistics', 'totalOrders', 'totalRevenue','labels', 'ordersCountPerDay', 'formattedDate', 'orderCount', 'revenuePerDay'));
    }

}