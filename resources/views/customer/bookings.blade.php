<x-app-layout>
    <div class="py-6">
        <div class="mb-8">
            <h1 class="text-3xl text-slate-900">My Bookings</h1>
            <p class="text-gray-500 mt-1">View and manage your rental history</p>
        </div>
        <a href="{{ route('customer.booking.history.show', 1) }}" class="block group">
            <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm flex flex-col md:flex-row items-center mb-6 hover:shadow-lg hover:-translate-y-1 transition-all duration-300">

                <img src="{{ asset('images/rav4.jpg') }}" class="w-full md:w-64 h-40 object-cover rounded-2xl mb-4 md:mb-0 md:mr-8" alt="Car">

                <div class="flex-1 w-full">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h3 class="text-xl font-bold text-slate-900 group-hover:text-blue-600 transition">Toyota Rav4</h3>
                            <p class="text-sm text-gray-400">Booking #1</p>
                        </div>
                        <span class="px-3 py-1 bg-orange-50 text-orange-600 text-xs font-bold rounded-full border border-orange-100">
                            Pending
                        </span>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-6">
                        <div>
                            <p class="text-xs text-gray-400 font-bold uppercase tracking-wider">Rental Period</p>
                            <p class="text-sm font-semibold text-slate-700">5/10/2026 - 5/15/2026</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 font-bold uppercase tracking-wider">Pickup Location</p>
                            <p class="text-sm font-semibold text-slate-700">Kampala - City Center</p>
                        </div>
                    </div>

                    <div class="flex items-center justify-between pt-4 border-t border-gray-50">
                        <div>
                            <p class="text-xs text-gray-400 uppercase font-bold tracking-tighter">Total Amount</p>
                            <p class="text-xl font-bold text-slate-900">UGX 600,000</p>
                        </div>

                        <div class="flex space-x-3">
                            @php $status = 'pending'; @endphp {{-- This will be $booking->status --}}

                            @if($status === 'pending')
                            <form action="#" method="POST" onclick="event.stopPropagation();">
                                @csrf
                                <button type="submit" class="px-6 py-2.5 rounded-xl text-sm font-bold bg-red-50 text-red-600 hover:bg-red-100 transition">
                                    Cancel Booking
                                </button>
                            </form>
                            @endif

                            <span class="text-slate-400 group-hover:text-slate-900 transition flex items-center text-sm font-bold">
                                View Details <i data-lucide="chevron-right" class="ml-1 w-4 h-4"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
</x-app-layout>
