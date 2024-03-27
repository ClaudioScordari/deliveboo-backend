<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'activity_name',
        'VAT_number',
        'address',
        'image',
        'description',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function plates()
    {
        return $this->hasMany(Plate::class);
    }

    public function types()
    {
        return $this->belongsToMany(Type::class);
    }
}
