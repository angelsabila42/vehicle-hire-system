<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'user_id',
        'vehicle_id',
        'pickup_location_id',
        'status',
        'payment',
        'startDate',
        'endDate',
        'reminder_sent'
    ];

    protected $casts = [
        'reminder_sent' => 'boolean',
    ];

     // Booking belongs to User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //Booking belongs to Vehicle
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id', 'VehicleId');
    }

    public function  pickupLocation(){
        return $this->belongsTo(PickupLocation::class, 'pickup_location_id');
    }

    public static function getEndingTodayCount(){
        $count = self::whereDate('endDate', now())->count();
        return $count . " ending today";
    }

}
