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

  public function getRestaurantByType(Request $request){

    $validDatas = $request->validate([
        'type' => 'required|string|in:Italiana,Cinese,Giapponese,Americana,Messicana,Indiana', 
    ]);

    $type = $validDatas['type'];

    $typeId = Type::where('name', $type)->value('id');

    $restaurants = Restaurant::whereHas('restaurant_type', function ($query) use ($typeId) {
        $query->where('type_id', $typeId);
    })->get();

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