<x-app-layout>
    <div class="py-6" x-data="bookingManager">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Dashboard</h1>
            <p class="text-gray-500 mt-1 font-medium">Welcome back! Here's what's happening today.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <x-stats-card title="Total Vehicles" :value="$totalVehicles" :trend="$vehicleTrend" icon="car" color="blue" :link="route('admin.vehicles')"/>
            <x-stats-card title="Available Vehicles" :value="$availableVehicles" trend="Ready to rent" icon="check-circle" color="green" :link="route('admin.vehicles', ['status' => 'Available'])"/>
            <x-stats-card title="Active Bookings" :value="$activeBookings" :trend="$bookingEnd" icon="clock" color="yellow" :link="route('admin.bookings', ['status' => 'Confirmed'])"/>
            <x-stats-card title="Pending Requests" :value="$pendingBookings" trend="Action required" icon="calendar" color="purple" :link="route('admin.bookings', ['status' => 'Pending'])"/>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 space-y-8">
                
                <div class="bg-white p-8 rounded-[2.5rem] border border-gray-100 shadow-sm">
                    <h3 class="text-xl font-bold text-slate-900 mb-6">Vehicle Status</h3>
                    <div class="space-y-6">
                        <div>
                            <div class="flex justify-between items-center mb-2">
                                <div class="flex items-center gap-2">
                                    <span class="w-3 h-3 rounded-full bg-emerald-500"></span>
                                    <span class="text-sm font-bold text-slate-600">Available</span>
                                </div>
                                <span class="text-sm font-extrabold text-slate-900">{{ $availableVehicles }}</span>
                            </div>
                            <div class="w-full bg-gray-100 rounded-full h-2.5">
                                <div class="bg-emerald-500 h-2.5 rounded-full" style="width: {{ $availablePercent }}%"></div>
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-between items-center mb-2">
                                <div class="flex items-center gap-2">
                                    <span class="w-3 h-3 rounded-full bg-blue-500"></span>
                                    <span class="text-sm font-bold text-slate-600">On Rent</span>
                                </div>
                                <span class="text-sm font-extrabold text-slate-900">{{ $onRentVehicles }}</span>
                            </div>
                            <div class="w-full bg-gray-100 rounded-full h-2.5">
                                <div class="bg-blue-500 h-2.5 rounded-full" style="width: {{ $onRentPercent }}%"></div>
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-between items-center mb-2">
                                <div class="flex items-center gap-2">
                                    <span class="w-3 h-3 rounded-full bg-amber-500"></span>
                                    <span class="text-sm font-bold text-slate-600">Maintenance</span>
                                </div>
                                <span class="text-sm font-extrabold text-slate-900">{{ $maintenanceVehicles }}</span>
                            </div>
                            <div class="w-full bg-gray-100 rounded-full h-2.5">
                                <div class="bg-amber-500 h-2.5 rounded-full" style="width: {{ $maintenancePercent }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-[2.5rem] border border-gray-100 shadow-sm overflow-hidden">
                    <div class="p-8 border-b border-gray-50 flex justify-between items-center">
                        <h3 class="text-xl font-bold text-slate-900">Recent Bookings</h3>
                        <a href="{{ route('admin.bookings') }}" class="text-sm font-bold text-blue-600 hover:text-blue-700">View All</a>
                    </div>
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-gray-50/50">
                            <tr>
                                <th class="px-8 py-4 text-[11px] font-extrabold text-gray-400 uppercase tracking-widest">Customer</th>
                                <th class="px-8 py-4 text-[11px] font-extrabold text-gray-400 uppercase tracking-widest">Vehicle</th>
                                <th class="px-8 py-4 text-[11px] font-extrabold text-gray-400 uppercase tracking-widest text-center">Status</th>
                                <th class="px-8 py-4 text-[11px] font-extrabold text-gray-400 uppercase tracking-widest text-right">Amount</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            <tr class="hover:bg-gray-50/50 transition-colors cursor-pointer" @click="openBookingDrawer({id: 1, customer_name: 'John Kamau', amount: '600,000', status: 'Confirmed'})">
                                <td class="px-8 py-5">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-500 font-bold text-xs">JK</div>
                                        <div>
                                            <div class="text-sm font-extrabold text-slate-900">John Kamau</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-5">
                                    <div class="text-sm font-bold text-slate-700">Toyota Rav4</div>
                                    <div class="text-[10px] text-gray-400 font-bold">5/10/2026</div>
                                </td>
                                <td class="px-8 py-5 text-center">
                                    <span class="px-3 py-1 rounded-lg bg-emerald-50 text-emerald-600 text-[10px] font-extrabold uppercase">Confirmed</span>
                                </td>
                                <td class="px-8 py-5 text-right font-extrabold text-slate-900 text-sm">
                                    <span class="text-[10px] text-gray-400 mr-1">UGX</span>600,000
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="space-y-6">
                <div class="bg-slate-900 p-8 rounded-[2.5rem] shadow-xl shadow-slate-200">
                    <h3 class="text-white font-bold text-xl mb-2">Quick Actions</h3>
                    <p class="text-slate-400 text-sm mb-8 font-medium">Manage your fleet efficiently</p>
                    
                    <div class="space-y-4">
                        <a href="{{ route('admin.vehicles') }}" class="w-full py-4 bg-white/10 hover:bg-white/20 text-white rounded-2xl font-bold transition-all text-left px-6 flex items-center justify-between group">
                            Add New Vehicle
                            <i data-lucide="plus-circle" class="w-5 h-5 text-slate-500 group-hover:text-white transition-colors"></i>
                        </a>
                        <a href="{{ route('admin.bookings', ['status' => 'Pending']) }}" class="w-full py-4 bg-white/10 hover:bg-white/20 text-white rounded-2xl font-bold transition-all text-left px-6 flex items-center justify-between group">
                            Review Pending Bookings
                            <i data-lucide="arrow-right-circle" class="w-5 h-5 text-slate-500 group-hover:text-white transition-colors"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        @include('admin.partials.booking-show-modal')
    </div>
</x-app-layout>