<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\RestaurantController as ApiRestaurantController;
use App\Http\Controllers\Api\PlateController as ApiPlateController;
use App\Http\Controllers\Api\TypeController as ApiTypeController;

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
    // Rotta per ottenere tutti i ristoranti
    Route::get('/restaurants', [ApiRestaurantController::class, 'index']);

    // Rotta per ottenere i dettagli di un singolo ristorante
    Route::get('/restaurants/{restaurant}', [ApiRestaurantController::class, 'show']);

    // Rotta per ottenere i piatti di un singolo ristorante
    Route::get('/restaurants/{restaurant}/plates', [ApiPlateController::class, 'showByRestaurant']);

    // Rotta per ottenere le tipologie di ristoranti
    Route::get('/types', [ApiTypeController::class, 'index']);
});