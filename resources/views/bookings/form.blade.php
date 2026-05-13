<!-- Booking Form Component -->
<div style="border: 1px solid #ddd; padding: 20px; border-radius: 5px; margin: 20px 0;">
    <h3>Book This Vehicle</h3>
    
    @if($errors->any())
        <div style="background-color: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin: 10px 0;">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('bookings.store') }}" method="POST">
        @csrf
        <input type="hidden" name="vehicle_id" value="{{ $vehicleId ?? 1 }}">
        
        <div style="margin: 10px 0;">
            <label for="start_date">Start Date:</label><br>
            <input type="date" name="start_date" id="start_date" required 
                   min="{{ date('Y-m-d') }}" value="{{ old('start_date') }}"
                   style="padding: 8px; width: 200px;">
        </div>
        
        <div style="margin: 10px 0;">
            <label for="end_date">End Date:</label><br>
            <input type="date" name="end_date" id="end_date" required 
                   value="{{ old('end_date') }}"
                   style="padding: 8px; width: 200px;">
        </div>
        
        <button type="submit" style="background-color: #007bff; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">
            Submit Booking Request
        </button>
    </form>
</div>

<script>
    // Ensure end date is after start date
    document.getElementById('start_date').addEventListener('change', function() {
        document.getElementById('end_date').min = this.value;
    });
</script>