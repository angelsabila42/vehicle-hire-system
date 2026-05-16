<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'user_id',
        'vehicle_id',
        'status',
        'pickUpLocation',
        'payment',
        'startDate',
        'endDate'
    ];

    protected $casts = [
        'pickUpLocation' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function pickupLocation()
    {
        return $this->belongsTo(PickupLocation::class, 'pickup_location_id');
    }

    public static function getEndingTodayCount()
    {
        $count = self::whereDate('endDate', now())->count();
        return $count . " ending today";
    }
}
