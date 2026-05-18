<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Booking; 

class BookingRejected extends Notification
{
    use Queueable;
     protected Booking $booking;

    /**
     * Create a new notification instance.
     */
    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
    
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        if (!$notifiable->notify_booking_rejected) {
            return [];
        }

        // Send to the database
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('Your request for a vehicle hire has been rejected. Please contact our support team for more information.    ')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }

    public function toDatabase($notifiable)
    {
        return [
            'title' => 'Booking Rejected',
            'message' => 'Your booking has been rejected. Please Contact the Help line for more information',
            'icon' => 'x',
            'type' => 'booking_rejected',
            'bg_color' => 'bg-red-100',
            'icon_color' => 'text-red-600',
            'booking_id' => $this->booking->id,
        ];
    }
}
