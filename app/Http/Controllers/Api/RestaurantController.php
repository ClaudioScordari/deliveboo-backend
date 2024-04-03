<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Type;
use App\Models\Plate;

class RestaurantController extends Controller
{
  public function index(){
    $restaurants = Restaurant::with('types', 'plates')->paginate(10);

    return response()->json([
        'success' => true,
        'results' => $restaurants,
    ]);
  }

  public function show(Restaurant $restaurant){

    return response()->json([
        'success' => true,
        'results' => $restaurant,
    ]);
  }

  public function getRestaurantByType($typeId)
  {
      // Trova il tipo corrispondente all'ID fornito
      $type = Type::findOrFail($typeId);
  
      // Ottieni i ristoranti associati a questo tipo
      $restaurants = $type->restaurants;
  
      // Restituisci i ristoranti trovati come JSON
      return response()->json([
          'success' => true,
          'results' => $restaurants,
      ]);
  }

    //   public function getDetailRestaurant($id){
    //     $restaurant = Restaurant::where('id', $id)->with('types', 'types')->first();
    //     if($restaurant->image) $restaurant->image = asset('storage/' . $restaurant->image) ;
    //         else{
    //             $restaurant->image = asset('storage/not-found.png') ;
    //         }

    //     return response()->json($restaurant);
    //   }


    //   public function search($tosearch){
    //     $restaurants = Restaurant::where('name','like',"%$tosearch%")->with('types', 'plates')->get();

    //     return response()->json($restaurants);
    //   }
}