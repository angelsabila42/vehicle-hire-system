<x-app-layout>
    <div x-data="vehicleManager(@js($vehicles->pluck('status')->unique()->values()))" class="space-y-10">
        <div class="flex justify-between items-end">
            <div>
                <h1 class="text-3xl font-extrabold text-slate-900 mb-2">Vehicle Management</h1>
                <p class="text-gray-400 font-medium">Manage your vehicle fleet</p>
            </div>
            <button @click="openAddModal()" class="flex items-center gap-2 bg-slate-900 text-white px-8 py-4 rounded-2xl font-bold shadow-xl shadow-slate-200 hover:bg-slate-800 transition-all">
                <i data-lucide="plus" class="w-5 h-5"></i> Add Vehicle
            </button>
        </div>

        <div class="bg-white p-2 rounded-[1.5rem] border border-gray-100 shadow-sm inline-flex items-center gap-2">
            <a href="{{ route('admin.vehicles') }}"
               class="px-8 py-3 rounded-[1.5rem] font-bold text-sm transition-colors {{ ! $status ? 'bg-slate-900 text-white' : 'text-gray-400 hover:bg-gray-50' }}">
                All
            </a>
            <a href="{{ route('admin.vehicles', ['status' => 'Available']) }}"
               class="px-8 py-3 rounded-[1.5rem] font-bold text-sm transition-colors {{ $status === 'Available' ? 'bg-slate-900 text-white' : 'text-gray-400 hover:bg-gray-50' }}">
                Available
            </a>
            <a href="{{ route('admin.vehicles', ['status' => 'Rented']) }}"
               class="px-8 py-3 rounded-[1.5rem] font-bold text-sm transition-colors {{ $status === 'Rented' ? 'bg-slate-900 text-white' : 'text-gray-400 hover:bg-gray-50' }}">
                Rented
            </a>
            <a href="{{ route('admin.vehicles', ['status' => 'Maintenance']) }}"
               class="px-8 py-3 rounded-[1.5rem] font-bold text-sm transition-colors {{ $status === 'Maintenance' ? 'bg-slate-900 text-white' : 'text-gray-400 hover:bg-gray-50' }}">
                Maintenance
            </a>
        </div>

        <div class="space-y-6 pb-12">
            @forelse($vehicles as $vehicle)
            <div class="group bg-white p-6 rounded-[2.5rem] border border-gray-100 shadow-sm flex items-center gap-8 hover:shadow-xl hover:shadow-slate-100/50 transition-all duration-500">

                <div class="w-56 h-36 rounded-3xl overflow-hidden shrink-0 shadow-inner bg-gray-50">
                    <img src="{{ $vehicle->image_url ?? asset('images/hire-logo2.png') }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="{{ $vehicle->make }} {{ $vehicle->model }}">
                </div>

                <div class="flex-grow space-y-1">
                    <div class="flex items-center gap-3">
                        <h3 class="text-xl text-slate-900">{{ $vehicle->make }} {{ $vehicle->model }}</h3>
                        <div class="flex items-center text-amber-400 text-sm font-bold">
                            <i data-lucide="star" class="w-4 h-4 fill-current mr-1"></i> {{ $vehicle->rating ?? '4.5' }}
                        </div>
                    </div>

                    <p class="text-gray-400 text-xs font-bold uppercase tracking-widest">{{ $vehicle->type }} • {{ $vehicle->year }}</p>

                    <div class="flex flex-col gap-2 pt-3">
                        <span class="text-gray-400 font-bold text-xs uppercase">{{ $vehicle->number_plate }}</span>

                        @php
                        $statusValue = is_array($vehicle->status) ? ($vehicle->status[0] ?? 'Unknown') : $vehicle->status;

                        $statusClasses = [
                        'Available' => 'bg-emerald-50 text-emerald-600',
                        'Maintenance' => 'bg-amber-50 text-amber-600',
                        'Under Maintenance' => 'bg-amber-50 text-amber-600',
                        'Rented' => 'bg-blue-50 text-blue-600',
                        'Booked' => 'bg-blue-50 text-blue-600',
                        'On Rent' => 'bg-blue-50 text-blue-600',
                        'Unavailable' => 'bg-red-50 text-red-600',
                        ];

                        $currentStatusClass = $statusClasses[$statusValue] ?? 'bg-gray-50 text-gray-600';
                        @endphp

                        <div>
                            <span class="{{ $currentStatusClass }} px-3 py-1 rounded-lg text-[10px] font-bold uppercase tracking-wider">
                                {{ $statusValue }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col justify-between items-end h-36 py-2">
                    <div class="text-right">
                        <p class="text-gray-400 text-xs mb-1">Daily Rate</p>
                        <p class="text-xl font-extrabold text-slate-900">UGX {{ number_format($vehicle->price_per_day) }}</p>
                    </div>

                    <div class="flex gap-3">
                        <button @click="openEditModal({{ json_encode($vehicle) }})" class="p-2.5 text-slate-400 hover:bg-gray-50 hover:text-slate-400 rounded-xl transition-all shadow-sm">
                            <i data-lucide="edit-3" class="w-5 h-5"></i>
                        </button>
                        <form action="{{ route('admin.vehicles.destroy', $vehicle->id) }}" method="POST"
                              onsubmit="return confirm('Delete this vehicle? This cannot be undone.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-2.5 text-red-400 hover:bg-red-50 hover:text-red-600 rounded-xl transition-all shadow-sm">
                                <i data-lucide="trash-2" class="w-5 h-5"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @empty
            <div class="text-center py-20 bg-white rounded-[2.5rem] border border-dashed border-gray-200">
                <p class="text-gray-400 font-medium">No vehicles found in the fleet.</p>
            </div>
            @endforelse
        </div>
        @include('admin.partials.edit-add-vehicle-modal')
    </div>
</x-app-layout>
