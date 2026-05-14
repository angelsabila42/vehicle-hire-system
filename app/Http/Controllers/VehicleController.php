<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
//    public function index()
// {
//     $vehicles = collect([
//         (object)[
//             'id' => 1, 'name' => 'Toyota Rav4', 'price' => 120000, 'image' => 'rav4.jpg',
//             'category' => 'SUV', 'transmission' => 'Automatic', 'rating' => 4.9,
//             'passengers' => 5, 'fuel_type' => 'Petrol', 'is_available' => true
//         ],
//         (object)[
//             'id' => 2, 'name' => 'Toyota Corolla', 'price' => 90000, 'image' => 'corolla.jpg',
//             'category' => 'Sedan', 'transmission' => 'Automatic', 'rating' => 4.8,
//             'passengers' => 5, 'fuel_type' => 'Petrol', 'is_available' => false, 'status' => 'Not Available'
//         ],
//         (object)[
//             'id' => 3, 'name' => 'Honda CR-V', 'price' => 110000, 'image' => 'crv.jpg',
//             'category' => 'SUV', 'transmission' => 'Automatic', 'rating' => 4.7,
//             'passengers' => 5, 'fuel_type' => 'Petrol', 'is_available' => true, 'isInsurred' => true, 'status' => 'Available',
//             'features' => ['Air Conditioning', 'Power Steering', 'ABS Brakes', 'Airbags', 'Bluetooth', 'USB Charging', 'Cruise Control', 'Backup Camera']
//         ],
//         (object)[
//             'id' => 4, 'name' => 'Honda Civic', 'price' => 85000, 'image' => 'civic.jpg',
//             'category' => ' Sedan', 'transmission' => 'Automatic', 'rating' => 4.6,
//             'passengers' => 5, 'fuel_type' => 'Petrol', 'is_available' => true, 'status' => 'Available'
//         ],
//         (object)[
//             'id' => 5, 'name' => 'Ford Mustang', 'price' => 150000, 'image' => 'mustang.jpg',
//             'category' => 'Sports', 'transmission' => 'Manual', 'rating' => 4.9,
//             'passengers' => 4, 'fuel_type' => 'Petrol', 'is_available' => true, 'status' => 'Available'
//         ],
//          (object)[
//             'id' => 6, 'name' => 'Tesla Model 3', 'price' => 130000, 'image' => 'model3.jpg',
//             'category' => 'Sedan', 'transmission' => 'Automatic', 'rating' => 4.8,
//             'passengers' => 5, 'fuel_type' => 'Electric', 'is_available' => true, 'status' => 'Available',
//             'isInsurred' => true,
//             'features' => ['Air Conditioning', 'Power Steering', 'ABS Brakes', 'Airbags', 'Bluetooth', 'USB Charging', 'Cruise Control', 'Backup Camera']
//         ],
//     ]);

//     return view('customer.vehicles', compact('vehicles'));
//     }

public function index(Request $request)
    {
        $query = Vehicle::query();

        if ($search = $request->query('search')) {
            $query->where(function ($sub) use ($search) {
                $sub->where('name', 'like', "%{$search}%")
                    ->orWhere('make', 'like', "%{$search}%")
                    ->orWhere('model', 'like', "%{$search}%");
            });
        }

        if ($category = $request->query('category')) {
            if ($category !== 'All') {
                $query->where('category', $category);
            }
        }

        if ($minPrice = $request->query('min_price')) {
            $query->where('price', '>=', intval($minPrice));
        }

        if ($maxPrice = $request->query('max_price')) {
            $query->where('price', '<=', intval($maxPrice));
        }

        $sort = $request->query('sort', 'price_asc');
        if ($sort === 'price_desc') {
            $query->orderBy('price', 'desc');
        } else {
            $query->orderBy('price', 'asc');
        }

        $vehicles = $query->get();
        $categories = Vehicle::query()
            ->select('category')
            ->distinct()
            ->pluck('category')
            ->filter()
            ->values()
            ->all();

        return view('customer.vehicles', compact('vehicles', 'categories'));
    }
//     public function adminVehicleIndex()
// {
//     $vehicles = collect([
//         (object)[
//             'name' => 'Toyota Rav4',
//             'image' => 'rav4.jpg',
//             'rating' => 4.9,
//             'type' => 'SUV',
//             'year' => 2023,
//             'plate_number' => 'UAH 123A',
//             'status' => ['Available', 'Rented', 'Under Maintenance'],
//             'price' => 120000,
//             'capacity' => 5,
//             'fuel_type' => 'Petrol',
//             'transmission' => 'Automatic'   ,
//             'isInsurred' => true,
//             'features' => ['Air Conditioning', 'Power Steering', 'ABS Brakes', 'Airbags', 'Bluetooth', 'USB Charging', 'Cruise Control', 'Backup Camera']
//         ],
//         (object)[
//             'name' => 'Honda Accord',
//             'image' => 'accord.jpg',
//             'rating' => 4.8,
//             'type' => 'Sedan',
//             'year' => 2022,
//             'plate_number' => 'UAG 456B',
//             'status' => ['Available', 'Rented', 'Under Maintenance'],
//             'price' => 80000,
//             'capacity' => 5,
//             'fuel_type' => 'Petrol',
//             'transmission' => 'Automatic',
//             'isInsurred' => true,
//             'features' => ['Air Conditioning', 'Power Steering', 'ABS Brakes', 'Airbags', 'Bluetooth', 'USB Charging', 'Cruise Control', 'Backup Camera'],
        
//         ]
//     ]);

//     return view('admin.vehicles', compact('vehicles'));
// }
  public function adminVehicleIndex()
    {
        $vehicles = Vehicle::orderBy('name')->get();
        $statusOptions = ['Available','Not Available'];

        return view('admin.vehicles', compact('vehicles', 'statusOptions'));
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
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'make' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
            'year' => 'nullable|digits:4|integer',
            'plate_number' => 'nullable|string|max:255',
            'price' => 'required|numeric|min:0',
            'transmission' => 'nullable|string|max:255',
            'fuel_type' => 'nullable|string|max:255',
            'status' => 'required|string|max:255',
            'is_available' => 'nullable|boolean',
            'rating' => 'nullable|numeric|min:0|max:5',
            'description' => 'nullable|string',
            'features' => 'nullable|array',
            'features.*' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:2048',
        ]);

        $data['is_available'] = $request->boolean('is_available', true);
        $data['features'] = $request->input('features', []);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('vehicles', 'public');
        }

        Vehicle::create($data);

        return redirect()->back()->with('success', 'Vehicle saved successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function showDetails(string $id)
    {
        $vehicle = Vehicle::findOrFail($id);

        return view('customer.vehicle-show', compact('vehicle'));
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
        $vehicle = Vehicle::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'make' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
            'year' => 'nullable|digits:4|integer',
            'plate_number' => 'nullable|string|max:255',
            'price' => 'required|numeric|min:0',
            'transmission' => 'nullable|string|max:255',
            'fuel_type' => 'nullable|string|max:255',
            'status' => 'required|string|max:255',
            'is_available' => 'nullable|boolean',
            'rating' => 'nullable|numeric|min:0|max:5',
            'description' => 'nullable|string',
            'features' => 'nullable|array',
            'features.*' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:2048',
        ]);

        $data['is_available'] = $request->boolean('is_available', true);
        $data['features'] = $request->input('features', []);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('vehicles', 'public');
        }

        $vehicle->update($data);

        return redirect()->back()->with('success', 'Vehicle updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $vehicle = Vehicle::findOrFail($id);
        $vehicle->delete();

        return redirect()->back()->with('success', 'Vehicle deleted successfully.');
    }
}
