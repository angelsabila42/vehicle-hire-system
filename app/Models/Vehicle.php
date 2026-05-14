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
        'plate_number',
        'price',
        'transmission',
        'fuel_type',
        'status',
        'is_available',
        'rating',
        'description',
        'features',
        'passengers',
        'insurance',
        'image',
    ];

    protected $casts = [
        'is_available' => 'boolean',
        'features' => 'array',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }


}
