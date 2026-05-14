<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Booking;
use App\Notifications\PickupReminder;

class SendPickupReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-pickup-reminders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $tomorrow = now()->addDay()->toDateString();
        $bookings = Booking::whereDate('pickup_date', $tomorrow)
            ->where('reminder_sent', false)
            ->get();

        foreach ($bookings as $booking) {
            $user = $booking->user;
            $user->notify(new PickupReminder($booking));

            $booking->update([
                'reminder_sent' => true,
            ]);
        }
    }
}
