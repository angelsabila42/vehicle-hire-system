<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');
    
    .font-jakarta {
        font-family: 'Plus Jakarta Sans', sans-serif;
    }
</style>

<x-app-layout>
    <div class="py-12 max-w-7xl mx-auto px-6 font-jakarta antialiased">
        
        <div class="mb-12">
            <h1 class="text-5xl font-extrabold text-slate-900 tracking-tight mb-4">Our Fleet</h1>
            <p class="text-gray-400 text-lg font-medium">Choose from our wide range of premium vehicles.</p>
            
            <div class="flex flex-wrap gap-3 mt-8">
                <button class="px-8 py-3 bg-slate-900 text-white rounded-2xl font-bold text-sm shadow-xl shadow-slate-200 transition-all">
                    All Vehicles
                </button>
                <button class="px-8 py-3 bg-white text-gray-400 border border-gray-100 rounded-2xl font-bold text-sm hover:bg-gray-50 transition-all">
                    SUVs
                </button>
                <button class="px-8 py-3 bg-white text-gray-400 border border-gray-100 rounded-2xl font-bold text-sm hover:bg-gray-50 transition-all">
                    Sedans
                </button>
                <button class="px-8 py-3 bg-white text-gray-400 border border-gray-100 rounded-2xl font-bold text-sm hover:bg-gray-50 transition-all">
                    Luxury
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($vehicles as $vehicle)
            <div class="group bg-white rounded-[2.5rem] border border-gray-100 shadow-xl shadow-slate-100/50 overflow-hidden hover:shadow-2xl hover:shadow-slate-200 transition-all duration-500">
                
                <div class="relative h-64 overflow-hidden">
                    <img src="{{ asset('images/' . $vehicle->image) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" alt="{{ $vehicle->name }}">
                    <div class="absolute top-6 right-6">
                        <div class="bg-white/90 backdrop-blur-md px-4 py-2 rounded-2xl shadow-sm border border-white/20">
                            <span class="text-slate-900 font-extrabold text-sm">UGX {{ number_format($vehicle->price) }}</span>
                            <span class="text-gray-400 text-[10px] font-bold uppercase ml-1">/ Day</span>
                        </div>
                    </div>
                </div>

                <div class="p-8">
                    <div class="flex justify-between items-start mb-6">
                        <div>
                            <h3 class="text-2xl font-extrabold text-slate-900 mb-1">{{ $vehicle->name }}</h3>
                            <p class="text-gray-400 text-[11px] font-bold uppercase tracking-[0.2em]">{{ $vehicle->category }} • {{ $vehicle->transmission }}</p>
                        </div>
                        <div class="flex items-center text-amber-400 bg-amber-50 px-3 py-1 rounded-xl">
                            <i data-lucide="star" class="w-3.5 h-3.5 fill-current"></i>
                            <span class="ml-1.5 text-slate-900 font-bold text-xs">{{ $vehicle->rating }}</span>
                        </div>
                    </div>

                    <div class="grid grid-cols-3 gap-3 mb-8">
                        <div class="bg-gray-50 rounded-2xl p-3 text-center border border-gray-100/50">
                            <i data-lucide="users" class="w-4 h-4 mx-auto mb-1 text-gray-400"></i>
                            <p class="text-[10px] font-bold text-slate-700">{{ $vehicle->passengers }} Seats</p>
                        </div>
                        <div class="bg-gray-50 rounded-2xl p-3 text-center border border-gray-100/50">
                            <i data-lucide="fuel" class="w-4 h-4 mx-auto mb-1 text-gray-400"></i>
                            <p class="text-[10px] font-bold text-slate-700">{{ $vehicle->fuel_type }}</p>
                        </div>
                        <div class="bg-gray-50 rounded-2xl p-3 text-center border border-gray-100/50">
                            <i data-lucide="zap" class="w-4 h-4 mx-auto mb-1 text-gray-400"></i>
                            <p class="text-[10px] font-bold text-slate-700">AC</p>
                        </div>
                    </div>

                    <a href="{{ route('customer.vehicles.show.details', $vehicle->id) }}" class="block w-full py-4 bg-slate-900 text-white text-center rounded-2xl font-bold text-sm hover:bg-slate-800 transition-all shadow-lg shadow-slate-100">
                        View Details
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</x-app-layout>