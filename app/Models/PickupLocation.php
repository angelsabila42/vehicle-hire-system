<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PickupLocation extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'address',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'pickup_location_id');
    }

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class, 'pickup_location_id');
    }

}
