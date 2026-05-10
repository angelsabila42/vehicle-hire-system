<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function adminIndex()
    {
        // $bookings = Booking::all(); // Later you will fetch all bookings
        return view('admin.bookings'); 
    }

    public function customerIndex()
    {
        // $bookings = auth()->user()->bookings; // Later you will fetch only their bookings
        return view('customer.bookings');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(string $id)
    {
        return view('customer.create-booking');
    }

    public function showBookingForm(string $id)
    {
        return view('customer.create-booking');
    }

    /**
     * Display Booking Form with Vehicle Details
     */

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
    public function showBooking(string $id)
    {
        // For now, we return the view. Later you'll fetch $booking = Booking::findOrFail($id);
        return view('customer.show');
    }

    public function showBookingHistory(string $id)
    {
        // For now, we return the view. Later you'll fetch $booking = Booking::findOrFail($id);
        return view('customer.show-history');
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
