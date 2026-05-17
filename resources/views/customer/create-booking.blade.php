<x-app-layout>
    <div class="py-12 max-w-7xl mx-auto px-6">
        <div class="mb-12">
            <h1 class="text-5xl font-extrabold text-slate-900 tracking-tight">Complete Your Booking</h1>
            <p class="text-gray-500 mt-3 text-lg">Please fill in the details below to reserve your vehicle.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-16">
            
            <div class="lg:col-span-8 bg-white rounded-[2rem] border border-gray-100 shadow-2xl shadow-slate-100/60 overflow-hidden p-10">
                <form action="#" method="POST" class="space-y-12">
                    @csrf
                    
                    <section>
                        <h2 class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.25em] mb-8 flex items-center">
                            <i data-lucide="calendar" class="mr-3 w-4 h-4 text-gray-400"></i> Rental Information
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div>
                                <label class="block text-sm font-bold text-slate-900 mb-3">Pickup Date</label>
                                <input type="date" class="w-full bg-gray-50 border-none rounded-2xl p-5 text-slate-900 focus:ring-2 focus:ring-slate-900 transition">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-slate-900 mb-3">Return Date</label>
                                <input type="date" class="w-full bg-gray-50 border-none rounded-2xl p-5 text-slate-900 focus:ring-2 focus:ring-slate-900 transition">
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-bold text-slate-900 mb-3">Pickup Location</label>
                                <select name="pickup_location_id" class="w-full bg-gray-50 border-none rounded-2xl p-5 text-slate-900 focus:ring-2 focus:ring-slate-900 transition appearance-none">
                                   <option value="">Select Pickup Location</option>
                                    @foreach($pickupLocations as $location)
                                        <option value="{{ $location->id }}">{{ $location->address }}</option>
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
                                <input type="text" placeholder="e.g. John Doe" class="w-full bg-gray-50 border-none rounded-2xl p-5 focus:ring-2 focus:ring-slate-900 transition placeholder:text-gray-300">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-slate-900 mb-3">Email Address</label>
                                <input type="email" placeholder="john@example.com" class="w-full bg-gray-50 border-none rounded-2xl p-5 focus:ring-2 focus:ring-slate-900 transition placeholder:text-gray-300">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-slate-900 mb-3">Phone Number</label>
                                <input type="tel" placeholder="+256 700 000 000" class="w-full bg-gray-50 border-none rounded-2xl p-5 focus:ring-2 focus:ring-slate-900 transition placeholder:text-gray-300">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-slate-900 mb-3">NIN</label>
                                <input type="tel" placeholder="CM1234567890" class="w-full bg-gray-50 border-none rounded-2xl p-5 focus:ring-2 focus:ring-slate-900 transition placeholder:text-gray-300">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-slate-900 mb-3">Driving License Number</label>
                                <input type="tel" placeholder="LM1234567890" class="w-full bg-gray-50 border-none rounded-2xl p-5 focus:ring-2 focus:ring-slate-900 transition placeholder:text-gray-300">
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
                            <img src="{{ asset('images/rav4.jpg') }}" class="w-28 h-20 object-cover rounded-[1.5rem]" alt="Toyota Rav4">
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
                            <span class="font-bold text-slate-900 text-lg">5 Days</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">Insurance</span>
                            <span class="font-bold text-green-600 text-lg">{{ $vehicle->insurance ? 'Free' : 'Not included' }}</span>
                        </div>
                        
                        <div class="pt-8 border-t border-gray-50 mt-4">
                            <p class="text-[10px] text-gray-400 font-bold uppercase tracking-[0.25em] mb-2">Total Amount</p>
                            <p class="text-4xl font-extrabold text-slate-900">UGX 600,000</p>
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
</x-app-layout>