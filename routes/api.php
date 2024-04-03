<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\RestaurantController as ApiRestaurantController;
use App\Http\Controllers\Api\PlateController as ApiPlateController;
use App\Http\Controllers\Api\TypeController as ApiTypeController;
use App\Http\Controllers\Api\OrderController as ApiOrderController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::name('api.')->group(function() {
    
    Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
        return $request->user();
    });

    // Rotta per ottenere tutti i ristoranti e il singolo ristorante
    Route::resource('restaurants', ApiRestaurantController::class)->only(['index', 'show']);

    // Rotta per ottenere le tipologie di ristoranti
    Route::get('/types', [ApiTypeController::class, 'index']);

    // Rotta per ottenere i piatti
    Route::get('/plates', [ApiPlateController::class, 'index']);
    
    // Rotta per ottenere i piatti di un singolo ristorante
    Route::get('/restaurants/{restaurant}/plates', [ApiPlateController::class, 'restaurantPlates']);

    // Ristoranti cercati per tipi
    Route::get('/restaurants/types/{typeId}', [ApiRestaurantController::class, 'getRestaurantByType']);

    // Ristoranti cercati per tipi
    Route::get('/restaurants/search/{name}', [ApiRestaurantController::class, 'search']);

    Route::post('/orders', [ApiOrderController::class, 'store'])->name('orders.store');

});