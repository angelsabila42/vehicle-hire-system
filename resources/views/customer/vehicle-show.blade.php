<x-app-layout>
    <div class="py-10 max-w-5xl mx-auto px-6 space-y-8">

        <div class="flex items-center">
            <a href="{{ route('dashboard') }}" class="flex items-center text-gray-500 hover:text-slate-900 transition">
                <i data-lucide="arrow-left" class="mr-2 w-5 h-5"></i> Back to vehicles
            </a>
        </div>

        <div class="space-y-4 mb-8">
            <div class="w-full h-[500px] rounded-[2.5rem] overflow-hidden shadow-sm">
                <img src="{{ asset('images/rav4-main.jpg') }}" class="w-full h-full object-cover" alt="Toyota Rav4 Main">
            </div>
            <div class="grid grid-cols-2 gap-4 h-64">
                <img src="{{ asset('images/rav4-interior.jpg') }}" class="w-full h-full object-cover rounded-[2rem]" alt="Interior">
                <img src="{{ asset('images/rav4-rear.jpg') }}" class="w-full h-full object-cover rounded-[2rem]" alt="Rear view">
            </div>
        </div>

        <div class="bg-white rounded-[1.0rem] p-8 border border-gray-50">
            <div class="flex justify-between items-start mb-6">
                <div>
                    <h1 class="text-3xl text-slate-900 mb-1">{{$vehicle->name}}</h1>
                    <p class="text-gray-400 font-medium">{{$vehicle->category}} • {{$vehicle->year}}</p>
                </div>
                <div class="flex items-center text-amber-400">
                    <i data-lucide="star" class="w-5 h-5 fill-current"></i>
                    <span class="ml-2 font-semibold text-slate-900">{{ $vehicle->rating }}</span>
                    <span class="ml-1 text-gray-400 text-sm">(124 reviews)</span>
                </div>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-10">
                <div class="flex items-center p-4 bg-gray-50/50 rounded-2xl border border-gray-100">
                    <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center shadow-sm mr-4">
                        <i data-lucide="users" class="w-5 h-5 text-slate-900"></i>
                    </div>
                    <div>
                        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-wider">Passengers</p>
                        <p class="font-bold text-slate-900">{{ $vehicle->passengers }}</p>
                    </div>
                </div>
                <div class="flex items-center p-4 bg-gray-50/50 rounded-2xl border border-gray-100">
                    <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center shadow-sm mr-4">
                        <i data-lucide="gauge" class="w-5 h-5 text-slate-900"></i>
                    </div>
                    <div>
                        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-wider">Transmission</p>
                        <p class="font-bold text-slate-900">{{ $vehicle->transmission }}</p>
                    </div>
                </div>
                <div class="flex items-center p-4 bg-gray-50/50 rounded-2xl border border-gray-100">
                    <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center shadow-sm mr-4">
                        <i data-lucide="fuel" class="w-5 h-5 text-slate-900"></i>
                    </div>
                    <div>
                        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-wider">Fuel Type</p>
                        <p class="font-bold text-slate-900">{{ $vehicle->fuel_type }}</p>
                    </div>
                </div>
                <div class="flex items-center p-4 bg-gray-50/50 rounded-2xl border border-gray-100">
                    <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center shadow-sm mr-4">
                        <i data-lucide="shield-check" class="w-5 h-5 text-slate-900"></i>
                    </div>
                    <div>
                        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-wider">Insurance</p>
                        <p class="font-bold text-slate-900">{{ $vehicle->insurance ? 'Included' : 'Not Included' }}</p>
                    </div>
                </div>
            </div>

            <div class="mb-10">
                <h3 class="text-xl text-slate-900 mb-4">About this vehicle</h3>
                <p class="text-gray-500 leading-relaxed">
                            {{ $vehicle->description }}
                </p>
            </div>

            <div class="mb-10 pt-10 border-t border-gray-100">
                <h3 class="text-xl text-slate-900 mb-6">Features</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-y-4">
                    @foreach($vehicle->features as $feature)
                    <div class="flex items-center text-gray-600">
                        <div class="w-1.5 h-1.5 rounded-full bg-slate-900 mr-3"></div>
                        <span class="font-medium">{{ $feature }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Booking Section -->
        <div class="lg:col-span-1">
            <div class="bg-white p-8 rounded-[1.0rem] border border-gray-100 shadow-xl sticky top-24">
                <p class="text-gray-400 font-semibold text-sm tracking-tighter">Price per day</p>
                <h2 class="text-4xl font-extrabold text-slate-900 mb-8">UGX {{ number_format($vehicle->price) }}</h2>

                <div class="space-y-4 mb-8">
                    <div class="flex items-center text-gray-500">
                        <i data-lucide="clock" class="w-5 h-5 mr-3"></i>
                        <span>Flexible pickup times</span>
                    </div>
                    <div class="flex items-center text-gray-500">
                        <i data-lucide="map-pin" class="w-5 h-5 mr-3"></i>
                        <span>Multiple pickup locations</span>
                    </div>
                    <div class="flex items-center text-gray-500">
                        <i data-lucide="shield" class="w-5 h-5 mr-3"></i>
                        <span>{{ $vehicle->insurance ? 'Full insurance included' : 'Insurance not included' }}</span>
                    </div>
                </div>

                <a href="{{ route('customer.booking.create', $vehicle->id) }}" class="block w-full bg-slate-900 text-white py-5 rounded-2xl font-bold text-xl text-center hover:bg-slate-800 transition-all shadow-lg shadow-slate-200 mb-4">
                    Book Now
                </a>

                <p class="text-center text-gray-400 text-sm">No payment required until pickup</p>

                <div class="mt-8 pt-8 border-t border-gray-100">
                    <div class="bg-green-50 text-green-700 p-4 rounded-2xl flex items-center justify-center space-x-2">
                        <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
                        <span class="font-bold">Available for immediate booking</span>
                    </div>
                </div>
            </div>

        </div>
</x-app-layout>
