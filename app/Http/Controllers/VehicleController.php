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
            $query->where('price', '>=', floatval($minPrice));
        }

        if ($maxPrice = $request->query('max_price')) {
            $query->where('price', '<=', floatval($maxPrice));
        }

        $sort = $request->query('sort', 'price_asc');
        if ($sort === 'price_desc') {
            $query->orderBy('price', 'desc');
        } else {
            $query->orderBy('price', 'asc');
        }

        $vehicles = $query->where('status', 'Available')->paginate(12)->withQueryString();
        $categories = Vehicle::query()
            ->select('category')
            ->distinct()
            ->pluck('category')
            ->filter()
            ->values()
            ->all();

        return view('customer.vehicles', compact('vehicles', 'categories', 'status'));
    }


    public function adminVehicleIndex()
    {
        $vehicles = Vehicle::orderBy('name')->get();
        $statusOptions = ['Available', 'Not Available'];

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
