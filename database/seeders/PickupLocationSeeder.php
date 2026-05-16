<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PickupLocation;

class PickupLocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $locations = [
            'Kampala - City Center',
            'Entebbe International Airport',
            'Jinja - Main Office',
            'Mbarara - Branch Office'
        ];

        foreach ($locations as $location) {
            PickupLocation::factory()->create([
                'address' => $location,
            ]);
        }
    }
}
