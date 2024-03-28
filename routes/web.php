<?php

use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\MainController;
use App\Http\Controllers\Admin\MainController as AdminMainController;
use App\Http\Controllers\Admin\RestaurantController as AdminRestaurantController;
use App\Http\Controllers\Admin\PlateController as AdminPlateController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\TypeController as AdminTypeController;
use App\Http\Controllers\Guest\RestaurantController as GuestRestaurantController;
use App\Http\Controllers\Guest\PlateController as GuestPlateController;

// Pubblico
use App\Http\Controllers\RestaurantController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Al caricamento della pagina vedo tutti i ristoranti
Route::get('/', [RestaurantController::class, 'index'])->name('home');

// Ristoranti (pubblici)
Route::prefix('restaurants')->name('guest.restaurants.')->group(function () {
    Route::get('/', [GuestRestaurantController::class, 'index'])->name('index');
    Route::get('/{restaurant}', [GuestRestaurantController::class, 'show'])->name('show');
});

// Piatti (pubblici)
Route::prefix('plates')->name('guest.plates.')->group(function () {
    Route::get('/', [GuestPlateController::class, 'index'])->name('index');

    Route::get('/{plate}', [GuestPlateController::class, 'show'])->name('show');
});


Route::prefix('admin')
    ->name('admin.')
    ->middleware('auth')
    ->group(function () {

    Route::get('/dashboard', [AdminMainController::class, 'dashboard'])->name('dashboard');

    // Ristoranti (protetti)
    Route::resource('restaurants', AdminRestaurantController::class);

    // Piatti (protetti)
    Route::resource('plates', AdminPlateController::class);

    // Ordini (protetti)
    Route::resource('orders', AdminOrderController::class);
    
    // Route::resource('types', AdminTypeController::class);

});

require __DIR__.'/auth.php';
