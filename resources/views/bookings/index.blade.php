<!DOCTYPE html>
<html>
<head>
    <title>My Bookings</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .booking-card { border: 1px solid #ddd; padding: 15px; margin: 10px 0; border-radius: 5px; }
        .status { padding: 5px 10px; border-radius: 3px; color: white; font-size: 12px; }
        .pending { background-color: #f39c12; }
        .approved { background-color: #27ae60; }
        .rejected { background-color: #e74c3c; }
    </style>
</head>
<body>
    <h1>My Bookings</h1>
    
    @if(session('success'))
        <div style="background-color: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin: 10px 0;">
            {{ session('success') }}
        </div>
    @endif

    @forelse($bookings as $booking)
        <div class="booking-card">
            <h3>Vehicle ID: {{ $booking->vehicle_id }}</h3>
            <p><strong>Dates:</strong> {{ $booking->start_date->format('M d, Y') }} - {{ $booking->end_date->format('M d, Y') }}</p>
            <p><strong>Status:</strong> <span class="status {{ $booking->status }}">{{ ucfirst($booking->status) }}</span></p>
            <p><strong>Booked on:</strong> {{ $booking->created_at->format('M d, Y H:i') }}</p>
        </div>
    @empty
        <p>No bookings found.</p>
    @endforelse
</body>
</html>