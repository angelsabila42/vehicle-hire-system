<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Vehicle;
use App\Models\PickUpLocation;
use App\Notifications\BookingPending;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Notification;
use App\Notifications\BookingCancelled;
use App\Notifications\BookingConfirmed;
use App\Notifications\BookingRejected;

class BookingController extends Controller
{
    public function adminIndex(Request $request)
    {
        $status = $request->query('status');
        $search = $request->query('search');

        $query = Booking::with(['user', 'vehicle']);

        if ($status && $status !== 'All') {
            $allowedStatuses = ['Confirmed', 'Pending', 'Cancelled', 'Rejected', 'Completed'];
            if (in_array($status, $allowedStatuses)) {
                $query->where('status', $status);
            }
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('status', 'LIKE', "%{$search}%")
                    ->orWhereHas('user', function ($u) use ($search) {
                        $u->where('name', 'LIKE', "%{$search}%")
                            ->orWhere('email', 'LIKE', "%{$search}%");
                    })
                    ->orWhereHas('vehicle', function ($v) use ($search) {
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

    public function create(string $id)
    {
        return $this->showBookingForm($id);
    }

    public function showBookingForm(string $id)
    {
        $vehicle = Vehicle::findOrFail($id);
        $pickupLocations = PickUpLocation::all();

        return view('customer.create-booking', compact('vehicle', 'pickupLocations'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'vehicle_id'      => 'required|exists:vehicles,id',
            'pickUpLocation'  => 'required|string|max:255',
            'payment'         => 'nullable|string|max:255',
            'startDate'       => 'required|date|after_or_equal:today',
            'endDate'         => 'required|date|after_or_equal:startDate',
        ]);

        // Double booking validation
        $existingBooking = Booking::where('vehicle_id', $request->vehicle_id)
            ->whereNotIn('status', ['Rejected', 'Cancelled'])
            ->where(function ($query) use ($request) {
                $query->whereBetween('startDate', [$request->startDate, $request->endDate])
                      ->orWhereBetween('endDate', [$request->startDate, $request->endDate])
                      ->orWhere(function ($q) use ($request) {
                          $q->where('startDate', '<=', $request->startDate)
                            ->where('endDate', '>=', $request->endDate);
                      });
            })
            ->exists();

        if ($existingBooking) {
            return redirect()->back()->withErrors([
                'dates' => 'Vehicle is not available for the selected dates.'
            ])->withInput();
        }

        $data['user_id'] = Auth::id();
        $data['status'] = 'Pending';

        $booking = Booking::create($data);

        $admins = User::where('role', 'admin')->get();
        Notification::send($admins, new BookingPending($booking));

        return redirect()->route('customer.bookings')->with('success', 'Booking request submitted successfully.');
    }

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

        return redirect()->back()->with('success', 'Booking approved successfully');
    }

    public function rejectBooking(string $id)
    {
        $booking = Booking::findOrFail($id);
        $booking->status = 'Rejected';
        $booking->save();

        $booking->user->notify(new BookingRejected($booking));

        return redirect()->back()->with('success', 'Booking rejected successfully');
    }

    public function completeBooking(string $id)
    {
        $booking = Booking::findOrFail($id);
        $booking->status = 'Completed';
        $booking->save();

        return redirect()->back()->with('success', 'Booking completed');
    }

    public function edit(string $id) {}

    public function update(Request $request, string $id) {}

    public function destroy(string $id) {}
}
