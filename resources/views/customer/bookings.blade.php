<x-app-layout>
    <div class="py-6">
        <div class="mb-8">
            <h1 class="text-3xl text-slate-900">My Bookings</h1>
            <p class="text-gray-500 mt-1">View and manage your rental history.</p>
        </div>

        @if ($bookings->isEmpty())
            <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm text-center">
                <p class="text-slate-700 text-lg font-semibold">No bookings found.</p>
                <p class="text-gray-500 mt-2">Browse available vehicles and make your first reservation.</p>
                <a href="{{ route('customer.vehicles.index') }}" class="inline-flex items-center mt-6 px-5 py-3 rounded-2xl bg-slate-900 text-white text-sm font-semibold hover:bg-slate-800 transition">
                    Browse Vehicles
                </a>
            </div>
        @else
            <div class="space-y-5">
                @foreach ($bookings as $booking)
                    <article class="group bg-white p-6 rounded-3xl border border-gray-100 shadow-sm hover:shadow-lg transition-all duration-300">
                        <a href="{{ route('customer.booking.history.show', $booking->id) }}" class="block">
                            <div class="flex flex-col md:flex-row md:items-center gap-6">
                                <img src="{{ $booking->vehicle->image_url ?? asset('images/hire-logo2.png') }}" alt="{{ $booking->vehicle->make }} {{ $booking->vehicle->model }}"
                                    class="w-full md:w-64 h-40 object-cover rounded-2xl shadow-sm">

                                <div class="flex-1 min-w-0">
                                    <div class="flex flex-col sm:flex-row sm:items-start justify-between gap-4 mb-4">
                                        <div>
                                            <h3 class="text-xl font-bold text-slate-900 group-hover:text-blue-600 transition">{{ $booking->vehicle->name }}</h3>
                                            <p class="text-sm text-gray-400 mt-1">Booking #{{ $booking->id }}</p>
                                        </div>
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-orange-50 text-orange-600 border border-orange-100">
                                            {{ ucfirst($booking->status) }}
                                        </span>
                                    </div>

                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-6">
                                        <div>
                                            <p class="text-xs text-gray-400 font-bold uppercase tracking-wider">Rental Period</p>
                                            <p class="text-sm font-semibold text-slate-700">
                                                {{ \Carbon\Carbon::parse($booking->startDate)->format('j/n/Y') }}
                                                -
                                                {{ \Carbon\Carbon::parse($booking->endDate)->format('j/n/Y') }}
                                            </p>
                                        </div>
                                        <div>
                                            <p class="text-xs text-gray-400 font-bold uppercase tracking-wider">Pickup Location</p>
                                            <p class="text-sm font-semibold text-slate-700">{{ $booking->pickupLocation->address ?? 'N/A' }}</p>
                                        </div>
                                    </div>

                                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 pt-4 border-t border-gray-100">
                                        <div>
                                            <p class="text-xs text-gray-400 uppercase font-bold tracking-wider">Payment</p>
                                            <p class="text-xl font-bold text-slate-900">{{ $booking->payment ? 'UGX ' . number_format((float) $booking->payment) : 'Not paid yet' }}</p>
                                        </div>

                                        <div class="inline-flex items-center text-sm font-semibold text-slate-500 group-hover:text-slate-900 transition">
                                            <span>View Details</span>
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 ml-1">
                                                <path fill-rule="evenodd" d="M13.97 4.97a.75.75 0 0 1 0 1.06L9.06 11.94h9.69a.75.75 0 0 1 0 1.5H9.06l4.91 4.91a.75.75 0 0 1-1.06 1.06l-6.5-6.5a.75.75 0 0 1 0-1.06l6.5-6.5a.75.75 0 0 1 1.06 0z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </article>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>
