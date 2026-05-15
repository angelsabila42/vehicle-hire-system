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

    public function pickupLocation()
    {
        return $this->belongsTo(PickupLocation::class, 'pickup_location_id');
    }

    public static function getMonthlyTrend()
    {
        $thisMonth = self::where('created_at', '>=', now()->startOfMonth())->count();
        $lastMonth = self::whereBetween('created_at', [
            now()->subMonth()->startOfMonth(),
            now()->subMonth()->endOfMonth()
        ])->count();

        $difference = $thisMonth - $lastMonth;

        if($difference > 0) {
            return "+$difference this month";
        } elseif($difference < 0) {
            return "$difference this month";
        } else {
            return "No change this month";
        }

    }

     protected $primaryKey = 'VehicleId';


}
   
  

