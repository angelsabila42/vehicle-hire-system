<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Booking;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\PickupLocation;

class BookingSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::where('email', 'customer@example.com')->first();
        $vehicle = Vehicle::first();
        $location = PickupLocation::inRandomOrder()->first();

        if ($user && $vehicle && $location) {
            Booking::create([
                'user_id' => $user->id,
                'vehicle_id' => $vehicle->VehicleId,
                'pickup_location_id' => $location->id,
                'status' => 'Pending',
                'payment' => 'Credit Card',
                'startDate' => now()->addDays(1)->toDateString(),
                'endDate' => now()->addDays(3)->toDateString(),
            ]);
        }
    }
}
