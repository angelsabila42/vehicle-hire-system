<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VehicleController extends Controller
{


    public function index(Request $request)
    {
        $status = $request->query('status');


        $query = Vehicle::query();

        if ($status && $status !== 'All') {
            $query->where('status', $status);
        }

        if ($search = $request->query('search')) {
            $query->where(function ($sub) use ($search) {
                $sub->where('make', 'like', "%{$search}%")
                    ->orWhere('model', 'like', "%{$search}%")
                    ->orWhere('number_plate', 'like', "%{$search}%");
            });
        }

        if ($category = $request->query('category')) {
            if ($category !== 'All') {
                $query->where('type', $category);
            }
        }

        if ($minPrice = $request->query('min_price')) {
            $query->where('price_per_day', '>=', floatval($minPrice));
        }

        if ($maxPrice = $request->query('max_price')) {
            $query->where('price_per_day', '<=', floatval($maxPrice));
        }

        $sort = $request->query('sort', 'price_asc');
        if ($sort === 'price_desc') {
            $query->orderBy('price_per_day', 'desc');
        } else {
            $query->orderBy('price_per_day', 'asc');
        }

        $vehicles = $query->where('status', 'Available')->paginate(12)->withQueryString();
        $categories = Vehicle::query()
            ->select('type')
            ->distinct()
            ->pluck('type')
            ->filter()
            ->values()
            ->all();

        return view('customer.vehicles', compact('vehicles', 'categories', 'status'));
    }


    public function adminVehicleIndex(Request $request)
    {
        $status = $request->query('status');

        $query = Vehicle::query()->orderBy('make');

        if ($status && $status !== 'All') {
            if ($status === 'Rented') {
                $query->whereIn('status', ['Rented', 'Booked', 'On Rent']);
            } elseif ($status === 'Maintenance') {
                $query->whereIn('status', ['Maintenance', 'Under Maintenance']);
            } else {
                $query->where('status', $status);
            }
        }

        $vehicles = $query->get();
        $statusOptions = ['Available', 'On Rent', 'Maintenance'];

        return view('admin.vehicles', compact('vehicles', 'statusOptions', 'status'));
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
            'name' => 'nullable|string|max:255',
            'make' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
            'year' => 'nullable|digits:4|integer',
            'number_plate' => 'nullable|string|max:255',
            'price_per_day' => 'required|numeric|min:0',
            'transmission' => 'nullable|string|max:255',
            'fuel_type' => 'nullable|string|max:255',
            'status' => 'required|string|max:255',
            'rating' => 'nullable|numeric|min:0|max:5',
            'description' => 'nullable|string',
            'features' => 'nullable|array',
            'features.*' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:2048',
            'sub_images' => 'nullable|array',             
            'sub_images.*' => 'nullable|image|max:2048',
        ]);

        $data['type'] = $data['category'] ?? 'Five Seater';
        unset($data['category']);
        $data['location'] = $data['location'] ?? 'Nairobi';
        $data['features'] = $request->input('features', []);

        //Image
        if ($request->hasFile('image')) {
        $data['image_path'] = $request->file('image')->store('vehicles', 'public');
        }

        //Sub images
        if ($request->hasFile('sub_images')) {
        $uploadedPaths = [];
        foreach ($request->file('sub_images') as $index => $file) {
            
            $path = $file->store('vehicles/sub', 'public');
            $uploadedPaths[] = $path;
        }
        $data['sub_images'] = $uploadedPaths;
        }

        Vehicle::create($data);

        return redirect()->back()->with('success', 'Vehicle saved successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function showDetails(string $id)
    {
        $vehicle = Vehicle::with('reviews')->findOrFail($id);

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
            'name' => 'nullable|string|max:255',
            'make' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
            'year' => 'nullable|digits:4|integer',
            'number_plate' => 'nullable|string|max:255',
            'price_per_day' => 'required|numeric|min:0',
            'transmission' => 'nullable|string|max:255',
            'fuel_type' => 'nullable|string|max:255',
            'status' => 'required|string|max:255',
            'rating' => 'nullable|numeric|min:0|max:5',
            'description' => 'nullable|string',
            'features' => 'nullable|array',
            'features.*' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:2048',
            'sub_images' => 'nullable|array',             
            'sub_images.*' => 'nullable|image|max:2048',
        ]);

        //Image
        if ($request->hasFile('image')) {
        $data['image_path'] = $request->file('image')->store('vehicles', 'public');
        }

        //Sub images
        if ($request->hasFile('sub_images')) {
        $uploadedPaths = [];
        foreach ($request->file('sub_images') as $index => $file) {
            
            $path = $file->store('vehicles/sub', 'public');
            $uploadedPaths[] = $path;
        }
        $data['sub_images'] = $uploadedPaths;
        }

        $data['type'] = $data['category'] ?? $vehicle->type;
        unset($data['category']);
        $data['features'] = $request->input('features', []);


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
