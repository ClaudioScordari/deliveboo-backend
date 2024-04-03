<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Plate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Braintree\Gateway;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'plates' => 'required|array',
            'plates.*.id' => 'required|exists:plates,id',
            'plates.*.quantity' => 'required|integer|min:1',
        ]);
    
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
    
        $validated = $validator->validated();
    
        DB::beginTransaction();
        try {
            $order = new Order;
            $order->restaurant_id = $request->restaurant_id;
            $order->name = $validated['name'];
            $order->phone = $validated['phone'];
            $order->address = $validated['address'];
            $order->payment_status = $request->payment_status;

            // Calcola il total_price
            $totalPrice = 0;
            foreach ($request->plates as $plate) {
                $plateDetails = Plate::find($plate['id']);
                if ($plateDetails) {
                    $totalPrice += $plateDetails->price * $plate['quantity'];
                }
            }
            // Assegna il total_price calcolato
            $order->total_price = $totalPrice;

            $order->save();
    
            foreach ($validated['plates'] as $plateData) {
                $plate = Plate::findOrFail($plateData['id']);
                $order->plates()->attach($plate, ['quantity' => $plateData['quantity']]);
                $totalPrice += $plate->price * $plateData['quantity'];
            }
    
            $order->total_price = $totalPrice;
            $order->save();
    
            DB::commit();
            return response()->json(['message' => 'Ordine creato con successo', 'order' => $order], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => "Errore nella creazione dell'ordine", 'error' => $e->getMessage()], 500);
        }
    }

}