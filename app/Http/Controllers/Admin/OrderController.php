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
        $mostOrderedPlatesData = [];
    
        for ($i = 12; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $monthName = $date->format('F Y');
            
            $monthlyOrders = Order::whereHas('plates', function ($query) use ($restaurantId) {
                                $query->where('restaurant_id', $restaurantId);
                            })
                            ->whereYear('created_at', $date->format('Y'))
                            ->whereMonth('created_at', $date->format('m'))
                            ->get();
            
            $ordersCount[] = $monthlyOrders->count();
            $revenuePerMonth[] = $monthlyOrders->sum('total_price');
            $months[] = $monthName;
    
            // Calcolo dei piatti più ordinati per il mese corrente
            $platesCount = [];
            foreach ($monthlyOrders as $order) {
                foreach ($order->plates as $plate) {
                    if (!array_key_exists($plate->id, $platesCount)) {
                        $platesCount[$plate->id] = ['name' => $plate->name, 'count' => 0];
                    }
                    $platesCount[$plate->id]['count'] += 1; // Assumi che tu abbia una relazione many-to-many con 'quantity' nella tabella pivot
                }
            }
    
            // Ordina e prendi i primi 5 piatti per numero di ordini
            usort($platesCount, function ($a, $b) {
                return $b['count'] - $a['count'];
            });
            $mostOrderedPlatesData[] = array_slice($platesCount, 0, 5);
        }
    
        return [
            'months' => $months,
            'ordersCount' => $ordersCount,
            'revenuePerMonth' => $revenuePerMonth,
            'mostOrderedPlatesData' => $mostOrderedPlatesData // Dati dei piatti più ordinati per ogni mese
        ];
    }

    public function getYearlyMostOrderedPlates($restaurantId)
    {
        $fromDate = Carbon::now()->subYear()->startOfDay();
        $toDate = Carbon::now()->endOfDay();
    
        $mostOrderedPlates = Plate::select('plates.*', DB::raw('SUM(order_plate.quantity) AS quantity_ordered'))
                                    ->join('order_plate', 'plates.id', '=', 'order_plate.plate_id')
                                    ->join('orders', 'order_plate.order_id', '=', 'orders.id')
                                    ->where('plates.restaurant_id', $restaurantId)
                                    ->whereBetween('orders.created_at', [$fromDate, $toDate])
                                    ->groupBy('plates.id')
                                    ->orderBy('quantity_ordered', 'desc')
                                    ->take(5)
                                    ->get();
    
        return $mostOrderedPlates;
    }

    public function getMostOrderedPlatesLast30Days($restaurantId) {
        $thirtyDaysAgo = Carbon::now()->subDays(29)->startOfDay();
        $today = Carbon::now()->endOfDay();
    
        $mostOrderedPlatesData = DB::table('orders')
            ->join('order_plate', 'orders.id', '=', 'order_plate.order_id')
            ->join('plates', 'order_plate.plate_id', '=', 'plates.id')
            ->select('plates.name', DB::raw('SUM(order_plate.quantity) as total_ordered'))
            ->where('plates.restaurant_id', $restaurantId)
            ->whereBetween('orders.created_at', [$thirtyDaysAgo, $today])
            ->groupBy('plates.name')
            ->orderBy('total_ordered', 'DESC')
            ->limit(5)
            ->get();
    
        return $mostOrderedPlatesData;
    }

    public function showMonthlyStatistics()
    {
        $user = auth()->user();
        if (!$user->restaurant) {
            return redirect()->route('admin.dashboard')->withErrors('Non hai un ristorante associato al tuo account.');
        }

        $restaurantId = $user->restaurant->id;
        $statistics = $this->getMonthlyOrdersStatistics($restaurantId);
        $mostOrderedPlates = $this->getYearlyMostOrderedPlates($restaurantId);
        $mostOrderedPlatesLast30Days = $this->getMostOrderedPlatesLast30Days($restaurantId);
    
        // Preparazione delle etichette e dei dati per la vista
        // Assicurati di calcolare correttamente i dati e di convertirli in array se necessario
        $plateNames = $mostOrderedPlates->pluck('name')->toArray();
        $plateQuantities = $mostOrderedPlates->pluck('quantity_ordered')->toArray();

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
        $startOfMonth = $today->copy()->startOfMonth();
        $endOfMonth = $today->copy()->endOfMonth();
        
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

        // Raccogliere dati per i piatti più ordinati
        $mostOrderedPlates = Plate::where('restaurant_id', $restaurantId)
        ->withCount(['orders as quantity_ordered' => function($query) {
            $query->select(DB::raw("sum(order_plate.quantity) as quantity_ordered"));
        }])
        ->join('order_plate', 'plates.id', '=', 'order_plate.plate_id')
        ->groupBy('plates.id', 'plates.name')
        ->orderBy('quantity_ordered', 'DESC')
        ->take(5) // Prendi i top 5 piatti più ordinati
        ->get(['plates.name', 'quantity_ordered']);

        $plateLabels = $mostOrderedPlates->pluck('name');
        $plateData = $mostOrderedPlates->pluck('quantity_ordered');

        $totalOrders = Order::whereHas('plates', function($query) use ($restaurantId) {
            $query->where('restaurant_id', $restaurantId);
        })->count();

        $totalRevenue = Order::whereHas('plates', function($query) use ($restaurantId) {
            $query->where('restaurant_id', $restaurantId);
        })->sum('total_price');

        // Calcolo dei soldi guadagnati nell'ultimo mese
        $monthlyRevenue = Order::whereHas('plates', function ($query) use ($restaurantId) {
            $query->where('restaurant_id', $restaurantId);
        })
        ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
        ->sum('total_price');

        // Calcolo del piatto più ordinato in generale
        $mostOrderedPlateOverall = Plate::where('restaurant_id', $restaurantId)
        ->withCount(['orders as orders_count' => function($query) {
            $query->select(DB::raw("sum(quantity)"));
        }])
        ->orderBy('orders_count', 'DESC')
        ->first();

        // Calcolo del piatto più ordinato dell'ultimo mese
        $mostOrderedPlateThisMonth = Plate::where('restaurant_id', $restaurantId)
        ->whereHas('orders', function($query) use ($startOfMonth, $endOfMonth) {
            $query->whereBetween('orders.created_at', [$startOfMonth, $endOfMonth]);
        })
        ->withCount(['orders as orders_count' => function($query) use ($startOfMonth, $endOfMonth) {
            $query->select(DB::raw("sum(quantity)"))->whereBetween('orders.created_at', [$startOfMonth, $endOfMonth]);
        }])
        ->orderBy('orders_count', 'DESC')
        ->first();

        return view('admin.stats.index', compact('statistics', 
                                                'totalOrders', 
                                                'totalRevenue',
                                                'labels', 
                                                'ordersCountPerDay', 
                                                'formattedDate', 
                                                'orderCount', 
                                                'revenuePerDay', 
                                                'plateLabels', 
                                                'plateData',
                                                'plateNames', 
                                                'plateQuantities',
                                                'mostOrderedPlatesLast30Days',
                                                'monthlyRevenue', 
                                                'mostOrderedPlateOverall', 
                                                'mostOrderedPlateThisMonth',
                                            ));
    }

}