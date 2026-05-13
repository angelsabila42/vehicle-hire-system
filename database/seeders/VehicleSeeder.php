<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Vehicle;

class VehicleSeeder extends Seeder
{
    public function run(): void
    {
        Vehicle::create([
            'number_plate' => 'UAH 123A',
            'make' => 'Toyota',
            'model' => 'Rav4',
            'year' => 2023,
            'price_per_day' => 50,000,
            'status' => 'Available',
            'image_path' => null,
            'type' => 'Five Seater',
        ]);

        Vehicle::create([
            'number_plate' => 'UAG 456B',
            'make' => 'Honda',
            'model' => 'Accord',
            'year' => 2022,
            'price_per_day' => 40,000,
            'status' => 'Available',
            'image_path' => null,
            'type' => 'Five Seater',
        ]);

        Vehicle::create([
            'number_plate' => 'UAZ 789C',
            'make' => 'Toyota',
            'model' => 'Vanguard',
            'year' => 2019,
            'price_per_day' => 150000,
            'status' => 'Available',
            'image_path' => null,
            'type' => 'Seven Seater',
        ]);

        Vehicle::create([
            'number_plate' => 'UA 089EF', 
            'make' => 'Subaru', 
            'model' => 'Outback'
            'year' => 2015,
            'price_per_day' => 45,000,
            'status' => 'Maintenance',
            'image-path' => null,
            'type' => 'Five Seater',
        ]);

        Vehicle::create([
            'number_plate' => 'UBH 778L', 
            'make' => 'Toyota', 
            'model' => 'Sienta'
            'year' => 2015,
            'price_per_day' => 50,000,
            'status' => 'Available',
            'image-path' => null,
            'type' => 'Seven Seater',
        ]);

        Vehicle::create([
            'number_plate' => 'UAR 576T', 
            'make' => 'Toyota', 
            'model' => 'Rav4'
            'year' => 2018,
            'price_per_day' => 45,000,
            'status' => 'Booked',
            'image-path' => null,
            'type' => 'Five Seater',
        ]);

        Vehicle::create([
            'number_plate' => 'UA 012AT', 
            'make' => 'Toyota', 
            'model' => 'Hilux'
            'year' => 2015
            'price_per_day' => 60,000,
            'status' => 'Available',
            'image-path' => null,
            'type' => 'Double Cabin'
        ]);
    }
}
