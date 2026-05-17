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
        'year',
        'number_plate',
        'price_per_day',
        'transmission',
        'fuel_type',
        'status',
        'rating',
        'description',
        'features',
        'location',
        'passengers',
        'type',
        'insurance',
        'image_path',
        'sub_images',

    ];

    protected $appends = [
        'category',
        'image_url',
        'id',
    ];

    protected $casts = [
        'features' => 'array',
        'sub_images' => 'array'
    ];

    public function getIdAttribute(): mixed
    {
        return $this->getKey();
    }

    public function getNameAttribute(): string
    {
        return trim(($this->attributes['make'] ?? '') . ' ' . ($this->attributes['model'] ?? ''));
    }

    public function getCategoryAttribute(): ?string
    {
        return $this->attributes['type'] ?? null;
    }

    public function getIsAvailableAttribute(): bool
    {
        return $this->status === 'Available';
    }

    public function getImageUrlAttribute(): ?string
    {
        $path = $this->image_path;

        if (! $path) {
            return null;
        }

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        if (str_starts_with($path, 'vehicles/')) {
            return asset('storage/' . $path);
        }

        if (str_starts_with($path, 'public/images/')) {
            return asset(str_replace('public/', '', $path));
        }

        if (str_starts_with($path, 'images/')) {
            return asset($path);
        }

        return asset('storage/' . ltrim($path, '/'));
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function pickupLocation()
    {
        return $this->belongsTo(PickupLocation::class, 'pickup_location_id');
    }

    protected $primaryKey = 'VehicleId';

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
}
   
  

