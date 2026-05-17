<x-app-layout>
    <div class="py-12 max-w-7xl mx-auto px-6">
        <div class="mb-12">
            <h1 class="text-5xl font-extrabold text-slate-900 tracking-tight">Complete Your Booking</h1>
            <p class="text-gray-500 mt-3 text-lg">Please fill in the details below to reserve your vehicle.</p>
        </div>

        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-2xl text-red-700 text-sm">
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-16">
            
            <div class="lg:col-span-8 bg-white rounded-[2rem] border border-gray-100 shadow-2xl shadow-slate-100/60 overflow-hidden p-10">
                <form action="{{ route('bookings.store') }}" method="POST" class="space-y-12">
                    @csrf
                    <input type="hidden" name="vehicle_id" value="{{ $vehicle->id }}">

                    <section>
                        <h2 class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.25em] mb-8 flex items-center">
                            <i data-lucide="calendar" class="mr-3 w-4 h-4 text-gray-400"></i> Rental Information
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div>
                                <label class="block text-sm font-bold text-slate-900 mb-3">Pickup Date</label>
                                <input type="date" name="startDate" id="startDate" value="{{ old('startDate') }}" min="{{ date('Y-m-d') }}" required class="w-full bg-gray-50 border-none rounded-2xl p-5 text-slate-900 focus:ring-2 focus:ring-slate-900 transition">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-slate-900 mb-3">Return Date</label>
                                <input type="date" name="endDate" id="endDate" value="{{ old('endDate') }}" min="{{ date('Y-m-d') }}" required class="w-full bg-gray-50 border-none rounded-2xl p-5 text-slate-900 focus:ring-2 focus:ring-slate-900 transition">
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-bold text-slate-900 mb-3">Pickup Location</label>
                                <select name="pickup_location_id" required class="w-full bg-gray-50 border-none rounded-2xl p-5 text-slate-900 focus:ring-2 focus:ring-slate-900 transition appearance-none">
                                    <option value="">Select Pickup Location</option>
                                    @foreach($pickupLocations as $location)
                                        <option value="{{ $location->id }}" {{ old('pickup_location_id') == $location->id ? 'selected' : '' }}>{{ $location->address }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </section>

                    <section class="pt-12 border-t border-gray-100">
                        <h2 class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.25em] mb-8 flex items-center">
                            <i data-lucide="user" class="mr-3 w-4 h-4 text-gray-400"></i> Personal Information
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="md:col-span-2">
                                <label class="block text-sm font-bold text-slate-900 mb-3">Full Name</label>
                                <input type="text" name="full_name" value="{{ Auth::user()->name }}" class="w-full bg-gray-50 border-none rounded-2xl p-5 focus:ring-2 focus:ring-slate-900 transition">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-slate-900 mb-3">Email Address</label>
                                <input type="email" name="email" value="{{ Auth::user()->email }}" class="w-full bg-gray-50 border-none rounded-2xl p-5 focus:ring-2 focus:ring-slate-900 transition">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-slate-900 mb-3">Phone Number</label>
                                <div class="flex bg-gray-50 rounded-2xl overflow-hidden focus-within:ring-2 focus-within:ring-slate-900">
                                    <span class="px-5 py-5 text-slate-900 font-bold bg-gray-100 text-sm">+256</span>
                                    <input type="tel" name="phone" id="phone" value="{{ old('phone') }}" placeholder="700 000 000" inputmode="numeric" pattern="[0-9]{9}" maxlength="9" title="Enter 9 digits after +256" required class="flex-1 bg-transparent border-none p-5 focus:ring-0 placeholder:text-gray-300">
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-slate-900 mb-3">NIN</label>
                                <input type="text" name="nin" value="{{ old('nin') }}" placeholder="CM1234567890" pattern="[A-Za-z0-9]{8,20}" title="NIN must be alphanumeric" required class="w-full bg-gray-50 border-none rounded-2xl p-5 focus:ring-2 focus:ring-slate-900 transition placeholder:text-gray-300">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-slate-900 mb-3">Driving License Number</label>
                                <input type="text" name="driving_license" value="{{ old('driving_license') }}" placeholder="LM1234567890" pattern="[A-Za-z0-9]{6,20}" title="License must be alphanumeric" required class="w-full bg-gray-50 border-none rounded-2xl p-5 focus:ring-2 focus:ring-slate-900 transition placeholder:text-gray-300">
                            </div>
                        </div>
                    </section>

                    <button type="submit" class="w-full py-6 bg-slate-900 text-white rounded-[2.5rem] font-bold text-xl hover:bg-slate-800 transition-all shadow-xl shadow-slate-100">
                        Confirm Booking
                    </button>
                </form>
            </div>

            <div class="lg:col-span-4">
                <div class="bg-white rounded-[2rem] border border-gray-100 shadow-2xl shadow-slate-100/60 overflow-hidden sticky top-12">
                    
                    <div class="p-10 border-b border-gray-50">
                        <h3 class="text-2xl font-bold text-slate-900 mb-6">Order Summary</h3>
                        <div class="flex items-center space-x-5">
                            @if($vehicle->image_url)
                                <img src="{{ $vehicle->image_url }}" class="w-28 h-20 object-cover rounded-[1.5rem]" alt="{{ $vehicle->name }}">
                            @else
                                <div class="w-28 h-20 bg-gray-100 rounded-[1.5rem] flex items-center justify-center">
                                    <i data-lucide="car" class="w-8 h-8 text-gray-400"></i>
                                </div>
                            @endif
                            <div>
                                <h4 class="font-bold text-lg text-slate-900">{{ $vehicle->make }} {{ $vehicle->model }}</h4>
                                <p class="text-sm text-gray-400 font-medium">{{ $vehicle->category }} • {{ $vehicle->transmission }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="p-10 space-y-6">
                        <div class="flex justify-between items-center">
                            <span class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">Daily Rate</span>
                            <span class="font-bold text-slate-900 text-lg">UGX {{ number_format($vehicle->price_per_day) }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">Rental Period</span>
                            <span id="rental-period" class="font-bold text-slate-900 text-lg">— Days</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">Insurance</span>
                            <span class="font-bold text-green-600 text-lg">{{ $vehicle->insurance ? 'Free' : 'Not included' }}</span>
                        </div>
                        
                        <div class="pt-8 border-t border-gray-50 mt-4">
                            <p class="text-[10px] text-gray-400 font-bold uppercase tracking-[0.25em] mb-2">Total Amount</p>
                            <p id="total-amount" class="text-4xl font-extrabold text-slate-900">UGX —</p>
                        </div>
                    </div>

                    <div class="mx-8 mb-10 p-8 bg-slate-900 rounded-[2rem] text-white">
                        <div class="flex items-center mb-4">
                            <i data-lucide="info" class="w-4 h-4 mr-2 text-slate-400"></i>
                            <span class="text-[10px] font-bold uppercase tracking-[0.25em] text-slate-400">Note</span>
                        </div>
                        <p class="text-sm text-slate-300 leading-relaxed font-medium">
                            Payment is handled physically at our office during vehicle pickup. Instant confirmation will be sent to your email.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const pricePerDay = {{ $vehicle->price_per_day }};
        const startInput = document.getElementById('startDate');
        const endInput = document.getElementById('endDate');

        function updateSummary() {
            const start = new Date(startInput.value);
            const end = new Date(endInput.value);

            if (startInput.value && endInput.value && end >= start) {
                const days = Math.round((end - start) / (1000 * 60 * 60 * 24)) + 1;
                const total = days * pricePerDay;
                document.getElementById('rental-period').textContent = days + (days === 1 ? ' Day' : ' Days');
                document.getElementById('total-amount').textContent = 'UGX ' + total.toLocaleString();
            } else {
                document.getElementById('rental-period').textContent = '— Days';
                document.getElementById('total-amount').textContent = 'UGX —';
            }
        }

        startInput.addEventListener('change', function () {
            endInput.min = this.value;
            updateSummary();
        });

        endInput.addEventListener('change', updateSummary);

        // Block non-numeric input on phone field (digits only)
        document.getElementById('phone').addEventListener('keypress', function (e) {
            if (!/[0-9]/.test(e.key)) e.preventDefault();
        });
    </script>
</x-app-layout>
