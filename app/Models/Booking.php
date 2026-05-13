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

     // Booking belongs to User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Booking belongs to Vehicle
     public function vehicle()
     {
         return $this->belongsTo(Vehicle::class);
     }

}
