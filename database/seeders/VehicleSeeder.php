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
            'price_per_day' => 40000,
            'status' => 'Available',
            'location' => 'Nairobi',
            'image_path' => 'images/rav4_new.png',
            'type' => 'Five Seater',
        ]);

        Vehicle::create([
            'number_plate' => 'UBG 456B',
            'make' => 'Honda',
            'model' => 'Accord',
            'year' => 2022,
            'price_per_day' => 40000,
            'status' => 'Available',
            'location' => 'Nairobi',
            'image_path' => 'images/accord.jpg',
            'type' => 'Five Seater',
        ]);

        Vehicle::create([
            'number_plate' => 'UAZ 789C',
            'make' => 'Toyota',
            'model' => 'Vanguard',
            'year' => 2019,
            'price_per_day' => 45000,
            'status' => 'Available',
            'location' => 'Nairobi',
            'image_path' => 'images/vanguard.jpg',
            'type' => 'Seven Seater',
        ]);

        Vehicle::create([
            'number_plate' => 'UA 089EF', 
            'make' => 'Subaru', 
            'model' => 'Outback',
            'year' => 2015,
            'price_per_day' => 40000,
            'status' => 'Maintenance',
            'location' => 'Nairobi',
            'image_path' => 'images/outback.jpg',
            'type' => 'Five Seater',
        ]);

        Vehicle::create([
            'number_plate' => 'UBH 778L', 
            'make' => 'Toyota', 
            'model' => 'Sienta',
            'year' => 2015,
            'price_per_day' => 45000,
            'status' => 'Available',
            'location' => 'Nairobi',
            'image_path' => 'images/sienta.jpg',
            'type' => 'Seven Seater',
        ]);

        Vehicle::create([
            'number_plate' => 'UAR 576T', 
            'make' => 'Toyota', 
            'model' => 'Rav4',
            'year' => 2018,
            'price_per_day' => 45000,
            'status' => 'Booked',
            'location' => 'Nairobi',
            'image_path' => 'images/rav4_2018.png',
            'type' => 'Five Seater',
        ]);

        Vehicle::create([
            'number_plate' => 'UA 012AT', 
            'make' => 'Toyota', 
            'model' => 'Hilux',
            'year' => 2015,
            'price_per_day' => 70000,
            'status' => 'Available',
            'location' => 'Nairobi',
            'image_path' => 'images/hilux.jpg',
            'type' => 'Double Cabin',
        ]);

        Vehicle::create([
            'number_plate' => 'UBC 367M', 
            'make' => 'Toyota', 
            'model' => 'Alphard',
            'year' => 2017,
            'price_per_day' => 55000,
            'status' => 'Available',
            'location' => 'Nairobi',
            'image_path' => null,
            'type' => 'Seven Seater',
        ]);
    }
}
