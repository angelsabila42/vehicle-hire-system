<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $primaryKey = 'VehicleId';

    protected $fillable = [
        'number_plate',
        'make',
        'model',
        'year',
        'price_per_day',
        'status',
        'image_path',
    ];
}