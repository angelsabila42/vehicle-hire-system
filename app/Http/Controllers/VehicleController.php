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
    // We create a collection of objects manually since the Model doesn't exist
    $vehicles = collect([
        (object)[
            'id' => 1,
            'name' => 'Toyota Rav4',
            'price' => 120000,
            'image' => 'rav4.jpg', // Make sure this image is in public/images/
            'category' => 'SUV',
            'transmission' => 'Automatic',
            'rating' => 4.9,
            'passengers' => 5,
            'fuel_type' => 'Petrol'
        ],
        (object)[
            'id' => 2,
            'name' => 'Toyota Landcruiser',
            'price' => 250000,
            'image' => 'landcruiser.jpg',
            'category' => 'Luxury',
            'transmission' => 'Automatic',
            'rating' => 5.0,
            'passengers' => 7,
            'fuel_type' => 'Diesel'
        ],
        (object)[
            'id' => 3,
            'name' => 'Toyota Premio',
            'price' => 80000,
            'image' => 'premio.jpg',
            'category' => 'Sedan',
            'transmission' => 'Automatic',
            'rating' => 4.7,
            'passengers' => 5,
            'fuel_type' => 'Petrol'
        ]
    ]);

    return view('customer.vehicles', compact('vehicles'));
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
