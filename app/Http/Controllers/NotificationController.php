<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function markAsRead(string $id)
    {
        /** @var \App\Models\User|null $user */
        $user = auth('web')->user();

        if (!$user) {
            return back();
        }

        $notification = $user
            ->notifications()
            ->findOrFail($id);

        $notification->markAsRead();

        $bookingId = $notification->data['booking_id'] ?? null;
        if ($bookingId) {
            
            if ($user->role === 'admin') {
                return redirect()->route('admin.bookings');
            }
            return redirect()->route('customer.booking.history.show', $bookingId);
        }

        return back();
    }

    public function markAllAsRead()
    {
        /** @var \App\Models\User|null $user */
        $user = auth('web')->user();

        if (!$user) {
            return back();
        }

        $user->unreadNotifications()->update(['read_at' => now()]);

        return back();
    }

    public function clearAll()
    {
        /** @var \App\Models\User|null $user */
        $user = auth('web')->user();

        if (!$user) {
            return back();
        }

        $user->notifications()->delete();

        return back();
    }

    public function destroy(string $id){
        /** @var \App\Models\User|null $user */
        $user = auth('web')->user();

        if (!$user) {
            return back();
        }

        $notification = $user
            ->notifications()
            ->findOrFail($id);

        $notification->delete();

        return back();
    }
}
