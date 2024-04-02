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
    $restaurants = Restaurant::with('types', 'plates')->get();
    $types = Type::all();
    $plates = Plate::all();

    return response()->json(compact('restaurants','types','plates'));
  }

  public function getAllTypes(){
    $types = Type::all();

    return response()->json(compact('types'));
  }

  public function getDetailRestaurant($id){
    $restaurant = Restaurant::where('id', $id)->with('types', 'types')->first();
    if($restaurant->image) $restaurant->image = asset('storage/' . $restaurant->image) ;
        else{
            $restaurant->image = asset('storage/not-found.png') ;
        }

    return response()->json($restaurant);
  }

  public function getRestaurantByType($name){
    $restaurants = Type::where('name', $name)->with('restaurants')->paginate(5);

    return response()->json($restaurants);
  }

  public function search($tosearch){
    $restaurants = Restaurant::where('name','like',"%$tosearch%")->with('types', 'plates')->get();

    return response()->json($restaurants);
  }
}