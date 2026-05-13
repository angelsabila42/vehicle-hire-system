<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function adminIndex(Request $request)
    {
      $status = $request->query('status');
      $query = Booking::with(['user', 'vehicle']);
      if ($status && $status != 'All') {    // Filter only if status exists and is not 'All'
        $query->where('status', $status);
      }
      $bookings = $query->get();
       return view('admin.bookings', compact('bookings', 'status'));
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
       $booking = Booking::with(['user', 'vehicle'])->findOrFail($id);
       return view('customer.show', compact('booking'));
    }

    public function showBookingHistory(string $id)
    {
        // For now, we return the view. Later you'll fetch $booking = Booking::findOrFail($id);
        return view('customer.show-history');
    }

    public function approveBooking(string $id)
    {
    $booking = Booking::findOrFail($id);
    $booking->status = 'Confirmed';
    $booking->save();
    return redirect()->back()
        ->with('success', 'Booking approved successfully');
    }

    public function rejectBooking(string $id)
    {
    $booking = Booking::findOrFail($id);
    $booking->status = 'Rejected';
    $booking->save();
    return redirect()->back()
        ->with('success', 'Booking rejected successfully');
    }

    public function completeBooking(string $id)
    {
    $booking = Booking::findOrFail($id);
    $booking->status = 'Completed';
    $booking->save();
    return redirect()->back()
        ->with('success', 'Booking marked as completed');
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
