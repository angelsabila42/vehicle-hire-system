<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Vehicle;
use App\Notifications\BookingPending;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Notification;
use App\Notifications\BookingCancelled;
use App\Notifications\BookingConfirmed;
use App\Notifications\BookingRejected;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function adminIndex(Request $request)
    {
        $status = $request->query('status');
        $search = $request->query('search');

        $query = Booking::with(['user', 'vehicle']);

        // Status Filter 
        if ($status && $status !== 'All') {
            $allowedStatuses = ['Confirmed', 'Pending', 'Cancelled', 'Rejected', 'Completed'];

            if (in_array($status, $allowedStatuses)) {
                $query->where('status', $status);
            }
        }

        //Search Logic
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('status', 'LIKE', "%{$search}%")
                    ->orWhereHas('user', function ($u) use ($search) {
                        $u->where('name', 'LIKE', "%{$search}%")
                            ->orWhere('email', 'LIKE', "%{$search}%");
                    })
                    ->orWhereHas('vehicle', function ($v) use ($search) {
                        // Check if your column is 'name' or 'make'/'model'
                        $v->where('make', 'LIKE', "%{$search}%")
                            ->orWhere('model', 'LIKE', "%{$search}%");
                    });
            });
        }

        $bookings = $query->latest()->paginate(10)->withQueryString();

        return view('admin.bookings', compact('bookings', 'status', 'search'));
    }

    public function customerIndex()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $bookings = Booking::with('vehicle')
            ->where('user_id', Auth::id())
            ->get();

        return view('customer.bookings', compact('bookings'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(string $id)
    {
        return $this->showBookingForm($id);
    }

    public function showBookingForm(string $id)
    {
        $vehicle = Vehicle::findOrFail($id);

        return view('customer.create-booking', compact('vehicle'));
    }

    /**
     * Display Booking Form with Vehicle Details
     */

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'pickUpLocation' => 'required|string|max:255',
            'payment' => 'nullable|string|max:255',
            'startDate' => 'required|date|after_or_equal:today',
            'endDate' => 'required|date|after_or_equal:startDate',
        ]);

        $data['user_id'] = Auth::id();
        $data['status'] = 'Pending';

        $booking = Booking::create($data);

        $admins = User::where('role', 'admin')->get();
        //Trigger Notification to Admin
        Notification::send($admins, new BookingPending($booking));

        return redirect()->route('customer.bookings')->with('success', 'Booking request submitted successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function showBooking(string $id)
    {

        $booking = Booking::with(['user', 'vehicle'])->findOrFail($id);
        return view('customer.show', compact('booking'));
    }

    public function showBookingHistory(string $id)
    {
        $booking = Booking::with(['vehicle'])->findOrFail($id);

        return view('customer.show-history', compact('booking'));
    }

    public function approveBooking(string $id)
    {
        $booking = Booking::findOrFail($id);
        $booking->status = 'Confirmed';
        $booking->save();

        $booking->user->notify(new BookingConfirmed($booking));

        return redirect()->back()
            ->with('success', 'Booking approved successfully');
    }

    public function rejectBooking(string $id)
    {
        $booking = Booking::findOrFail($id);
        $booking->status = 'Rejected';
        $booking->save();

        //Notification to User about Rejection
        $booking->user->notify(new BookingRejected($booking));

        return redirect()->back()
            ->with('success', 'Booking rejected successfully');
    }

    public function completeBooking(string $id)
    {
        $booking = Booking::findOrFail($id);
        $booking->status = 'Completed';
        $booking->save();
        return redirect()->back()
            ->with('success', 'Booking completed');
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
