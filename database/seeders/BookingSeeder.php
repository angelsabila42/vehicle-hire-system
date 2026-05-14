<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Booking;
use App\Models\User;
use App\Models\Vehicle;

class BookingSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::where('email', 'customer@example.com')->first();
        $vehicle = Vehicle::first();

        if ($user && $vehicle) {
            Booking::create([
                'user_id' => $user->id,
                'vehicle_id' => $vehicle->VehicleId,
                'status' => 'pending',
                'pickUpLocation' => [
                    'Kampala - City Center',
                    'Entebbe International Airport',
                    'Jinja - Main Office',
                    'Mbarara - Branch Office'
                ],
                'payment' => 'Credit Card',
                'startDate' => now()->addDays(1)->toDateString(),
                'endDate' => now()->addDays(3)->toDateString(),
            ]);
        }
    }
}
