<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'payment_status'
    ];

    use HasFactory;

    public function plates()
    {
        return $this->belongsToMany(Plate::class, 'order_plate')->withPivot('quantity');
    }
}
