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


}
