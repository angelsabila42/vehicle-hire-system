<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index()
{
    $vehicles = collect([
        (object)[
            'id' => 1, 'name' => 'Toyota Rav4', 'price' => 120000, 'image' => 'rav4.jpg',
            'category' => 'SUV', 'transmission' => 'Automatic', 'rating' => 4.9,
            'passengers' => 5, 'fuel_type' => 'Petrol', 'is_available' => true
        ],
        (object)[
            'id' => 2, 'name' => 'Toyota Corolla', 'price' => 90000, 'image' => 'corolla.jpg',
            'category' => 'Sedan', 'transmission' => 'Automatic', 'rating' => 4.8,
            'passengers' => 5, 'fuel_type' => 'Petrol', 'is_available' => false, 'status' => 'Not Available'
        ],
        (object)[
            'id' => 3, 'name' => 'Honda CR-V', 'price' => 110000, 'image' => 'crv.jpg',
            'category' => 'SUV', 'transmission' => 'Automatic', 'rating' => 4.7,
            'passengers' => 5, 'fuel_type' => 'Petrol', 'is_available' => true, 'isInsurred' => true, 'status' => 'Available',
            'features' => ['Air Conditioning', 'Power Steering', 'ABS Brakes', 'Airbags', 'Bluetooth', 'USB Charging', 'Cruise Control', 'Backup Camera']
        ],
        (object)[
            'id' => 4, 'name' => 'Honda Civic', 'price' => 85000, 'image' => 'civic.jpg',
            'category' => ' Sedan', 'transmission' => 'Automatic', 'rating' => 4.6,
            'passengers' => 5, 'fuel_type' => 'Petrol', 'is_available' => true, 'status' => 'Available'
        ],
        (object)[
            'id' => 5, 'name' => 'Ford Mustang', 'price' => 150000, 'image' => 'mustang.jpg',
            'category' => 'Sports', 'transmission' => 'Manual', 'rating' => 4.9,
            'passengers' => 4, 'fuel_type' => 'Petrol', 'is_available' => true, 'status' => 'Available'
        ],
         (object)[
            'id' => 6, 'name' => 'Tesla Model 3', 'price' => 130000, 'image' => 'model3.jpg',
            'category' => 'Sedan', 'transmission' => 'Automatic', 'rating' => 4.8,
            'passengers' => 5, 'fuel_type' => 'Electric', 'is_available' => true, 'status' => 'Available',
            'isInsurred' => true,
            'features' => ['Air Conditioning', 'Power Steering', 'ABS Brakes', 'Airbags', 'Bluetooth', 'USB Charging', 'Cruise Control', 'Backup Camera']
        ],
    ]);

    return view('customer.vehicles', compact('vehicles'));
    }


    public function adminVehicleIndex()
{
    $vehicles = collect([
        (object)[
            'name' => 'Toyota Rav4',
            'image' => 'rav4.jpg',
            'rating' => 4.9,
            'type' => 'SUV',
            'year' => 2023,
            'plate_number' => 'UAH 123A',
            'status' => ['Available', 'Rented', 'Under Maintenance'],
            'price' => 120000,
            'capacity' => 5,
            'fuel_type' => 'Petrol',
            'transmission' => 'Automatic'   ,
            'isInsurred' => true,
            'features' => ['Air Conditioning', 'Power Steering', 'ABS Brakes', 'Airbags', 'Bluetooth', 'USB Charging', 'Cruise Control', 'Backup Camera']
        ],
        (object)[
            'name' => 'Honda Accord',
            'image' => 'accord.jpg',
            'rating' => 4.8,
            'type' => 'Sedan',
            'year' => 2022,
            'plate_number' => 'UAG 456B',
            'status' => ['Available', 'Rented', 'Under Maintenance'],
            'price' => 80000,
            'capacity' => 5,
            'fuel_type' => 'Petrol',
            'transmission' => 'Automatic',
            'isInsurred' => true,
            'features' => ['Air Conditioning', 'Power Steering', 'ABS Brakes', 'Airbags', 'Bluetooth', 'USB Charging', 'Cruise Control', 'Backup Camera'],
        
        ]
    ]);

    return view('admin.vehicles', compact('vehicles'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function showDetails(string $id)
    {
    return view('customer.vehicle-show');
    }

     public function show()
    {
    //return view('customer.vehicle-show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
