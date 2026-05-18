<x-app-layout>
    <div class="py-6 max-w-5xl mx-auto space-y-6">
        <div class="flex flex-col space-y-4">
            <a href="{{ route('customer.bookings') }}" class="flex items-center text-gray-500 hover:text-slate-900 transition text-sm font-medium">
                <i data-lucide="arrow-left" class="mr-2 w-4 h-4"></i> Back to bookings
            </a>

            <div class="flex justify-between items-start">
                <div>
                    <h1 class="text-3xl text-slate-900">Booking Details</h1>
                    <p class="text-gray-400 mt-1">Booking #{{ $booking->id }}</p>
                </div>
                <span class="px-4 py-1.5 rounded-full border flex items-center text-sm font-semibold
                    {{ $booking->status === 'Confirmed' ? 'bg-green-50 text-green-600 border-green-100' :
                      ($booking->status === 'Pending'   ? 'bg-orange-50 text-orange-600 border-orange-100' :
                      ($booking->status === 'Cancelled' || $booking->status === 'Rejected' ? 'bg-red-50 text-red-600 border-red-100' :
                       'bg-gray-50 text-gray-600 border-gray-100')) }}">
                    <i data-lucide="check-circle" class="w-4 h-4 mr-2"></i> {{ $booking->status }}
                </span>
            </div>
        </div>

        @if (session('success'))
            <div class="p-4 bg-green-50 border border-green-100 text-green-700 rounded-2xl text-sm">{{ session('success') }}</div>
        @endif

        <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="p-8 space-y-10">

                {{-- Vehicle Information --}}
                <section>
                    <h2 class="text-sm font-bold tracking-widest mb-6 flex items-center">
                        <i data-lucide="car" class="mr-2 w-4 h-4"></i> Vehicle Information
                    </h2>
                    <div class="flex items-center">
                        @if($booking->vehicle->image_url)
                            <img src="{{ $booking->vehicle->image_url }}" class="w-32 h-20 object-cover rounded-xl mr-6" alt="{{ $booking->vehicle->name }}">
                        @else
                            <div class="w-32 h-20 bg-gray-100 rounded-xl mr-6 flex items-center justify-center">
                                <i data-lucide="car" class="w-8 h-8 text-gray-400"></i>
                            </div>
                        @endif
                        <div>
                            <h3 class="text-lg font-bold text-slate-900">{{ $booking->vehicle->make }} {{ $booking->vehicle->model }}</h3>
                            <p class="text-gray-400 text-sm">{{ $booking->vehicle->category }}</p>
                            <p class="text-sm font-medium text-slate-500 mt-1">Daily Rate: <span class="text-slate-900">UGX {{ number_format($booking->vehicle->price_per_day) }}</span></p>
                        </div>
                    </div>
                </section>

                {{-- Rental Details --}}
                <section>
                    <h2 class="text-sm font-bold tracking-widest mb-6 flex items-center">
                        <i data-lucide="calendar" class="mr-2 w-4 h-4"></i> Rental Details
                    </h2>
                    @php
                        $start = \Carbon\Carbon::parse($booking->startDate);
                        $end   = \Carbon\Carbon::parse($booking->endDate);
                        $days  = $start->diffInDays($end) + 1;
                    @endphp
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="bg-gray-50 p-5 rounded-2xl">
                            <p class="text-xs text-gray-400 font-bold uppercase mb-1">Pickup Date</p>
                            <p class="font-semibold text-slate-700">{{ $start->format('l, F j, Y') }}</p>
                        </div>
                        <div class="bg-gray-50 p-5 rounded-2xl">
                            <p class="text-xs text-gray-400 font-bold uppercase mb-1">Return Date</p>
                            <p class="font-semibold text-slate-700">{{ $end->format('l, F j, Y') }}</p>
                        </div>
                        <div class="bg-gray-50 p-5 rounded-2xl">
                            <p class="text-xs text-gray-400 font-bold uppercase mb-1">Pickup Location</p>
                            <div class="flex items-center font-semibold text-slate-700">
                                <i data-lucide="map-pin" class="w-4 h-4 mr-2 text-gray-400"></i>
                                {{ $booking->pickupLocation->address ?? 'N/A' }}
                            </div>
                        </div>
                        <div class="bg-gray-50 p-5 rounded-2xl">
                            <p class="text-xs text-gray-400 font-bold uppercase mb-1">Rental Duration</p>
                            <p class="font-semibold text-slate-700">{{ $days }} {{ $days === 1 ? 'day' : 'days' }}</p>
                        </div>
                    </div>
                </section>

                {{-- Customer Information --}}
                <section class="bg-white border border-gray-100 rounded-3xl p-8">
                    <h2 class="text-sm font-bold tracking-widest mb-6 flex items-center">
                        <i data-lucide="user" class="mr-2 w-4 h-4"></i> Customer Information
                    </h2>
                    <div class="grid grid-cols-1 gap-y-4">
                        <div class="flex items-center"><i data-lucide="user" class="w-4 h-4 text-gray-400 mr-4"></i> <span class="text-gray-500 w-32">Full Name:</span> <span class="font-semibold">{{ $booking->user->name }}</span></div>
                        <div class="flex items-center"><i data-lucide="mail" class="w-4 h-4 text-gray-400 mr-4"></i> <span class="text-gray-500 w-32">Email:</span> <span class="font-semibold">{{ $booking->user->email }}</span></div>
                        <div class="flex items-center"><i data-lucide="phone" class="w-4 h-4 text-gray-400 mr-4"></i> <span class="text-gray-500 w-32">Phone:</span> <span class="font-semibold">{{ $booking->phone ?? 'N/A' }}</span></div>
                    </div>
                </section>

                {{-- Booking Timeline --}}
                <section>
                    <h2 class="text-sm font-bold tracking-widest mb-8">Booking Timeline</h2>
                    <div class="space-y-8 relative before:absolute before:inset-y-0 before:left-5 before:w-px before:bg-gray-100">
                        <div class="relative flex items-start">
                            <div class="absolute left-0 w-10 h-10 bg-green-50 rounded-full border-4 border-white flex items-center justify-center">
                                <i data-lucide="check" class="w-4 h-4 text-green-600"></i>
                            </div>
                            <div class="ml-16">
                                <p class="font-bold text-slate-900 leading-none">Booking Created</p>
                                <p class="text-sm text-gray-500 mt-1">Your booking request has been submitted</p>
                                <p class="text-xs text-gray-400 mt-1">{{ $booking->created_at->format('j/n/Y') }}</p>
                            </div>
                        </div>
                    </div>
                </section>

                {{-- Price Summary --}}
                <section class="space-y-4 pt-6">
                    <h2 class="text-xl font-bold text-slate-900">Price Summary</h2>
                    @php $total = $booking->vehicle->price_per_day * $days; @endphp
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">Base rate (UGX {{ number_format($booking->vehicle->price_per_day) }} × {{ $days }} {{ $days === 1 ? 'day' : 'days' }})</span>
                        <span class="font-bold text-slate-900">UGX {{ number_format($total) }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">Insurance</span>
                        <span class="{{ $booking->vehicle->insurance ? 'text-green-600' : 'text-gray-500' }} font-medium">
                            {{ $booking->vehicle->insurance ? 'Included' : 'Not included' }}
                        </span>
                    </div>
                    <div class="flex justify-between text-2xl font-bold pt-6 border-t border-gray-100">
                        <span>Total Amount</span>
                        <span>UGX {{ number_format($total) }}</span>
                    </div>
                </section>

                <div class="bg-blue-50 rounded-2xl p-6 border border-blue-100">
                    <h4 class="text-blue-800 font-bold mb-3">Important Information</h4>
                    <ul class="text-blue-700 text-sm space-y-2 list-disc list-inside">
                        <li>Please bring your ID and driver's license</li>
                        <li>Arrive 15 minutes before pickup time</li>
                        <li>Payment due at pickup location</li>
                    </ul>
                </div>

                @if(in_array($booking->status, ['Pending', 'Confirmed']))
                    {{-- Cancel Button triggers modal --}}
                    <button type="button" onclick="document.getElementById('cancelModal').classList.remove('hidden')"
                        class="w-full py-4 bg-red-50 text-red-600 font-bold rounded-2xl hover:bg-red-100 transition border border-red-100">
                        Cancel Booking
                    </button>

                    {{-- Cancel Modal --}}
                    <div id="cancelModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/40 backdrop-blur-sm px-4">
                        <div class="bg-white rounded-3xl shadow-2xl w-full max-w-md p-8">
                            <h3 class="text-xl font-bold text-slate-900 mb-2">Cancel Booking</h3>
                            <p class="text-gray-400 text-sm mb-6">Please select or provide a reason for cancellation.</p>

                            <form action="{{ route('customer.booking.cancel', $booking->id) }}" method="POST" id="cancelForm">
                                @csrf
                                @method('PATCH')

                                <div class="space-y-3 mb-4">
                                    @foreach([
                                        'Change of plans',
                                        'Found a better option',
                                        'Financial constraints',
                                        'Travel plans changed',
                                        'Vehicle no longer needed',
                                        'Other'
                                    ] as $reason)
                                        <label class="flex items-center gap-3 p-4 rounded-2xl border border-gray-100 cursor-pointer hover:bg-gray-50 transition has-[:checked]:border-slate-900 has-[:checked]:bg-slate-50">
                                            <input type="radio" name="reason_choice" value="{{ $reason }}" class="accent-slate-900" onchange="handleReasonChange(this.value)">
                                            <span class="text-sm font-semibold text-slate-700">{{ $reason }}</span>
                                        </label>
                                    @endforeach
                                </div>

                                <div id="customReasonWrapper" class="hidden mb-4">
                                    <textarea id="customReason" placeholder="Type your reason here..." rows="3"
                                        class="w-full bg-gray-50 border-none rounded-2xl p-4 text-sm focus:ring-2 focus:ring-slate-900 placeholder:text-gray-300"></textarea>
                                </div>

                                <input type="hidden" name="cancellation_reason" id="cancellation_reason">

                                @error('cancellation_reason')
                                    <p class="text-red-500 text-xs mb-3">{{ $message }}</p>
                                @enderror

                                <div class="flex gap-3 mt-6">
                                    <button type="button" onclick="document.getElementById('cancelModal').classList.add('hidden')"
                                        class="flex-1 py-3 rounded-2xl border border-gray-200 text-gray-500 font-bold hover:bg-gray-50 transition">
                                        Go Back
                                    </button>
                                    <button type="button" onclick="submitCancel()"
                                        class="flex-1 py-3 rounded-2xl bg-red-600 text-white font-bold hover:bg-red-700 transition">
                                        Confirm Cancel
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <script>
                        function handleReasonChange(value) {
                            const wrapper = document.getElementById('customReasonWrapper');
                            wrapper.classList.toggle('hidden', value !== 'Other');
                        }

                        function submitCancel() {
                            const choice = document.querySelector('input[name="reason_choice"]:checked');
                            if (!choice) {
                                alert('Please select a reason for cancellation.');
                                return;
                            }
                            const reason = choice.value === 'Other'
                                ? document.getElementById('customReason').value.trim()
                                : choice.value;

                            if (!reason) {
                                alert('Please type your reason for cancellation.');
                                return;
                            }

                            document.getElementById('cancellation_reason').value = reason;
                            document.getElementById('cancelForm').submit();
                        }
                    </script>
                @else
                    <div class="w-full py-4 bg-gray-50 text-gray-400 font-bold rounded-2xl text-center border border-gray-100">
                        Booking cannot be cancelled
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
