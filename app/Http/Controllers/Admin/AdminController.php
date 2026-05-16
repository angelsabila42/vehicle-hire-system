<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Auth;
use App\Models\PickupLocation;

class AdminController extends Controller
{
    public function index()
    {
            /** @var \App\Models\User $user */
        $user = Auth::user();
        $totalVehicles = Vehicle::where('manager_id', $user->id)->count();
        $availableVehicles = Vehicle::where('manager_id', $user->id)->where('status', 'available')->count();

        $activeBookings = Booking::where('status', 'confirmed')->count();
        $pendingBookings = Booking::where('status', 'pending')->count();

        $vehicleTrend = Vehicle::getMonthlyTrend();
        $bookingEnd = Booking::getEndingTodayCount();

        $user = Auth::user();

        $vehicles = Vehicle::where('manager_id', $user->id)->get();

        return view('admin.index', compact(
            'vehicles',
            'activeBookings',
            'availableVehicles',
            'pendingBookings',
            'totalVehicles',
            'vehicleTrend',
            'bookingEnd'
        ));
    }

    

    public function settings()
    {
        $locations = PickupLocation::all();
        return view('admin.settings', compact('locations'));
    }

    public function updateSettings(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $request->validate([
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        $user->update([
            'email'         => $request->email,
            'notify_new_bookings' => $request->has('notify_new_bookings'),
            'notify_booking_cancelled' => $request->has('notify_booking_cancelled'),
            'notify_booking_pending' => $request->has('notify_booking_pending')
        ]);

        if ($request->filled('new_location_address')) {
        PickupLocation::create([
            'address' => $request->new_location_address
        ]);
    }


        return back()->with('success', 'Settings updated successfully.');
    }

    public function destroyLocation($id)
{
    $location = PickupLocation::findOrFail($id);
    
    $location->delete();

    return back()->with('success', 'Location removed successfully.');
}
}
