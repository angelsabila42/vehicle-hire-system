<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'make',
        'model',
        'name',
        'category',
        'year',
         'number_plate',
        'price_per_day',
        'transmission',
        'fuel_type',
        'status',
        'is_available',
        'rating',
        'description',
        'features',
        'location',
        'passengers',
         'type',
        'insurance',
        'image_path',
    ];

    protected $casts = [
        'is_available' => 'boolean',
        'features' => 'array',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

     protected $primaryKey = 'VehicleId';


}
   
  

