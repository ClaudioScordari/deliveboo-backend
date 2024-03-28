<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plate extends Model
{
    protected $fillable = [
        'restaurant_id','name', 'price', 'visible', 'ingredients', 'image', 'description'
    ];

    use HasFactory;

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_plate')->withPivot('quantity');
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
}
