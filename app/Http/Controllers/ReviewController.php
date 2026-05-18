<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Review;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request, string $bookingId)
    {
        $booking = Booking::where('id', $bookingId)
            ->where('user_id', Auth::id())
            ->where('status', 'Completed')
            ->firstOrFail();

        // Prevent duplicate reviews
        if (Review::where('booking_id', $booking->id)->where('user_id', Auth::id())->exists()) {
            return redirect()->back()->with('error', 'You have already reviewed this booking.');
        }

        $request->validate([
            'rating'  => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:500',
        ]);

        Review::create([
            'user_id'    => Auth::id(),
            'vehicle_id' => $booking->vehicle_id,
            'booking_id' => $booking->id,
            'rating'     => $request->rating,
            'comment'    => $request->comment,
        ]);

        // Recalculate and update vehicle average rating
        $avg = Review::where('vehicle_id', $booking->vehicle_id)->avg('rating');
        Vehicle::where('VehicleId', $booking->vehicle_id)->update(['rating' => round($avg, 1)]);

        return redirect()->back()->with('success', 'Thank you for your review!');
    }
}
