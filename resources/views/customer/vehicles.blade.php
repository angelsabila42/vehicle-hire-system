<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');
    .font-jakarta { font-family: 'Plus Jakarta Sans', sans-serif; }
</style>

<x-app-layout>
    <div class="py-12 max-w-7xl mx-auto px-6 font-jakarta antialiased">
        <!-- Header Section -->
        <div class="mb-12">
            <h1 class="text-4xl text-slate-900 tracking-tight mb-2">Available Vehicles</h1>
            <p class="text-gray-400 text-lg font-medium mb-8">Choose from our wide range of quality vehicles</p>

            <!-- Search Form -->
            @php
                $currentSearch = request('search', '');
                $currentCategory = request('category', 'All');
            @endphp

            <form method="GET" action="{{ route('customer.vehicles.index') }}" class="flex flex-col md:flex-row md:items-center gap-4 bg-gray-50/50 p-2 rounded-[2rem] border border-gray-100">
                <div class="relative flex-grow">
                    <i data-lucide="search" class="absolute left-6 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-300"></i>
                    <input type="text" name="search" value="{{ old('search', $currentSearch) }}" placeholder="Search vehicles..."
                        class="w-full pl-14 pr-6 py-4 bg-white border-none rounded-[1.5rem] focus:ring-2 focus:ring-slate-900/5 placeholder-gray-300 text-slate-600 shadow-sm">
                </div>

                @if($currentCategory !== 'All')
                    <input type="hidden" name="category" value="{{ $currentCategory }}">
                @endif

                <button type="submit" class="px-6 py-3 bg-slate-900 text-white rounded-2xl font-bold text-sm shadow-lg shadow-slate-200 transition-all">
                    Search
                </button>
            </form>

            <!-- Category Filters -->
            <div class="flex flex-wrap items-center gap-2 p-1 mt-4">
                <a href="{{ route('customer.vehicles.index', array_filter(['search' => $currentSearch, 'category' => 'All'])) }}"
                    class="px-6 py-3 rounded-2xl text-sm font-bold transition-all {{ $currentCategory === 'All' ? 'bg-slate-900 text-white shadow-lg shadow-slate-200' : 'text-gray-400 hover:bg-white hover:text-slate-900' }}">
                    All Vehicles
                </a>

                @foreach($categories as $category)
                    <a href="{{ route('customer.vehicles.index', array_filter(['search' => $currentSearch, 'category' => $category])) }}"
                        class="px-6 py-3 rounded-2xl text-sm font-bold transition-all {{ $currentCategory === $category ? 'bg-slate-900 text-white shadow-lg shadow-slate-200' : 'text-gray-400 hover:bg-white hover:text-slate-900' }}">
                        {{ $category }}
                    </a>
                @endforeach
            </div>

            <!-- Vehicle Count -->
            <div class="mt-8">
                <p class="text-gray-400 text-sm tracking-wider">Showing {{ $vehicles->count() }} vehicles</p>
            </div>
        </div>

        <!-- Vehicles Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($vehicles as $vehicle)
                <a href="{{ route('customer.vehicles.show.details', $vehicle->VehicleId) }}" class="group bg-white rounded-[2.5rem] border border-gray-100 shadow-xl shadow-slate-100/50 overflow-hidden relative transition-all duration-500 ease-out hover:-translate-y-3 hover:shadow-[0_30px_60px_-15px_rgba(0,0,0,0.1)]">
                    <!-- Availability Overlay -->
                    @if(!$vehicle->is_available)
                        <div class="absolute inset-0 z-20 bg-slate-900/40 backdrop-blur-[2px] flex items-center justify-center p-8">
                            <div class="bg-white px-8 py-3 rounded-full shadow-2xl">
                                <span class="text-slate-900 font-bold">Not Available</span>
                            </div>
                        </div>
                    @endif

                    <!-- Vehicle Image -->
                    <div class="relative h-64 overflow-hidden">
                        <img src="{{ $vehicle->image_url ?? asset('images/hire-logo2.png') }}" class="w-full h-full object-cover transition-transform duration-700 ease-in-out group-hover:scale-110" alt="{{ $vehicle->make }} {{ $vehicle->model }}">
                        @if($vehicle->is_available)
                            <div class="absolute bottom-6 right-6 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <div class="bg-emerald-50/90 backdrop-blur-md px-4 py-1.5 rounded-xl border border-emerald-100">
                                    <span class="text-emerald-600 font-bold text-[10px] uppercase tracking-widest">Available</span>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Vehicle Details -->
                    <div class="p-8">
                        <div class="flex justify-between items-start mb-6">
                            <div>
                                <h3 class="text-2xl text-slate-900 mb-1">{{ $vehicle->make }} {{ $vehicle->model }}</h3>
                                <p class="text-gray-400 text-[11px] tracking-[0.25em] mb-4">{{ $vehicle->category }}</p>
                                <p class="text-gray-400 text-[11px] tracking-[0.15em]">{{ $vehicle->passengers }} passengers • {{ $vehicle->transmission }}</p>
                            </div>
                            <div class="flex items-center text-amber-400">
                                <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                                <span class="ml-1 text-slate-900 font-bold text-sm">{{ $vehicle->rating }}</span>
                            </div>
                        </div>

                        <hr class="my-4 border-gray-200">

                        <!-- Pricing -->
                        <div class="pt-6 border-t border-gray-50">
                            <p class="text-gray-400 text-xs font-bold uppercase mb-1">Per day</p>
                            <p class="text-xl text-slate-900">UGX {{ number_format($vehicle->price_per_day) }}</p>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</x-app-layout>