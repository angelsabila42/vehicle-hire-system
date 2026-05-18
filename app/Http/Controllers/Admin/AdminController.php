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
        $totalVehicles = Vehicle::count();
        $availableVehicles = Vehicle::where('status', 'Available')->count();
        $onRentVehicles = Vehicle::whereIn('status', ['Booked', 'Rented', 'On Rent'])->count();
        $maintenanceVehicles = Vehicle::whereIn('status', ['Maintenance', 'Under Maintenance'])->count();

        $availablePercent = $totalVehicles > 0 ? round(($availableVehicles / $totalVehicles) * 100) : 0;
        $onRentPercent = $totalVehicles > 0 ? round(($onRentVehicles / $totalVehicles) * 100) : 0;
        $maintenancePercent = $totalVehicles > 0 ? round(($maintenanceVehicles / $totalVehicles) * 100) : 0;

        $activeBookings = Booking::where('status', 'Confirmed')->count();
        $pendingBookings = Booking::where('status', 'Pending')->count();

        $vehicleTrend = Vehicle::getMonthlyTrend();
        $bookingEnd = Booking::getEndingTodayCount();

        return view('admin.index', compact(
            'activeBookings',
            'availableVehicles',
            'onRentVehicles',
            'maintenanceVehicles',
            'availablePercent',
            'onRentPercent',
            'maintenancePercent',
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

    public function destroyLocation(string $id)
{
    $location = PickupLocation::findOrFail( $id);
    
    $location->delete();

    return back()->with('success', 'Location removed successfully.');
}
}
