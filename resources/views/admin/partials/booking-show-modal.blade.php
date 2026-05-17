<div x-show="bookingDrawerOpen" class="fixed inset-0 z-[60] overflow-hidden" x-cloak>
    <div x-show="bookingDrawerOpen" 
         x-transition:enter="ease-in-out duration-500" 
         x-transition:enter-start="opacity-0" 
         x-transition:enter-end="opacity-100" 
         x-transition:leave="ease-in-out duration-500" 
         x-transition:leave-start="opacity-100" 
         x-transition:leave-end="opacity-0" 
         @click="bookingDrawerOpen = false"
         class="absolute inset-0 bg-slate-900/40 backdrop-blur-sm transition-opacity"></div>

    <div class="fixed inset-y-0 right-0 pl-10 max-w-full flex">
        <div x-show="bookingDrawerOpen" 
             x-transition:enter="transform transition ease-in-out duration-500 sm:duration-700" 
             x-transition:enter-start="translate-x-full" 
             x-transition:enter-end="translate-x-0" 
             x-transition:leave="transform transition ease-in-out duration-500 sm:duration-700" 
             x-transition:leave-start="translate-x-0" 
             x-transition:leave-end="translate-x-full" 
             class="w-screen max-w-md">
            
            <div class="h-full flex flex-col bg-white shadow-2xl  overflow-hidden">
                <div class="p-8 pb-6 flex items-center justify-between">
                    <div>
                        <h2 class="text-2xl font-extrabold text-slate-900">Booking Details</h2>
                        <p class="text-sm text-gray-400 font-bold mt-1" x-text="'Booking #' + selectedBooking.id"></p>
                    </div>
                    <button @click="bookingDrawerOpen = false" class="p-2 hover:bg-gray-100 rounded-full transition-colors">
                        <i data-lucide="x" class="w-6 h-6 text-gray-400"></i>
                    </button>
                </div>

                <div class="flex-1 overflow-y-auto px-8 space-y-6">
                    <div class="bg-gray-50 rounded-3xl p-6 space-y-4">
                        <div class="flex items-center gap-2 text-slate-900 mb-2">
                            <i data-lucide="user" class="w-5 h-5"></i>
                            <span class="font-bold">Customer Information</span>
                        </div>
                        <div class="grid grid-cols-1 gap-3">
                            <div>
                                <p class="text-[10px] uppercase font-extrabold text-gray-400 tracking-wider">Name</p>
                                <p class="text-sm font-bold text-slate-700" x-text="selectedBooking.customer_name"></p>
                            </div>
                            <div>
                                <p class="text-[10px] uppercase font-extrabold text-gray-400 tracking-wider">Email</p>
                                <p class="text-sm font-bold text-slate-700" x-text="selectedBooking.customer_email"></p>
                            </div>
                            <div>
                                <p class="text-[10px] uppercase font-extrabold text-gray-400 tracking-wider">Phone</p>
                                <p class="text-sm font-bold text-slate-700" x-text="selectedBooking.customer_phone || '+256 700 123456'"></p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-50 rounded-3xl p-6">
                        <div class="flex items-center gap-2 text-slate-900 mb-4">
                            <i data-lucide="car" class="w-5 h-5"></i>
                            <span class="font-bold">Vehicle</span>
                        </div>
                        <p class="text-sm font-bold text-slate-700" x-text="selectedBooking.vehicle_name"></p>
                    </div>

                    <div class="bg-gray-50 rounded-3xl p-6">
                        <div class="flex items-center gap-2 text-slate-900 mb-4">
                            <i data-lucide="calendar" class="w-5 h-5"></i>
                            <span class="font-bold">Rental Period</span>
                        </div>
                        <div class="space-y-3">
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-400 font-bold">Pickup:</span>
                                <span class="text-sm font-bold text-slate-700" x-text="selectedBooking.pickup_date"></span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-400 font-bold">Return:</span>
                                <span class="text-sm font-bold text-slate-700" x-text="selectedBooking.return_date || '5/15/2026'"></span>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-50 rounded-3xl p-6">
                        <div class="flex items-center gap-2 text-slate-900 mb-4">
                            <i data-lucide="map-pin" class="w-5 h-5"></i>
                            <span class="font-bold">Pickup Location</span>
                        </div>
                        <p class="text-sm font-bold text-slate-700" x-text="selectedBooking.location"></p>
                    </div>

                    <div class="pt-4 space-y-4">
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-400 font-bold">Status</span>
                            <span class="px-3 py-1 rounded-lg bg-amber-50 text-amber-600 text-[11px] font-extrabold uppercase tracking-tight" x-text="selectedBooking.status"></span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-400 font-bold">Total Amount</span>
                            <p class="text-xl font-extrabold text-slate-900">
                                <span class="text-xs text-gray-400 mr-1 uppercase">UGX</span>
                                <span x-text="selectedBooking.amount"></span>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="p-8 bg-white border-t border-gray-50 flex gap-4">
                    <form :action="'{{ url('/admin/bookings') }}/' + selectedBooking.id + '/approve'" method="POST" class="flex-1">
                    @csrf
                        <button type="submit" class="w-full py-4 bg-emerald-500 text-white rounded-2xl font-bold hover:bg-emerald-600 transition-all shadow-lg shadow-emerald-100">
                        Approve
                        </button>
                    </form>
                   <form :action="'{{ url('/admin/bookings') }}/' + selectedBooking.id + '/reject'" method="POST" class="flex-1">
                   @csrf
                        <button type="submit" class="w-full py-4 bg-red-600 text-white rounded-2xl font-bold hover:bg-red-700 transition-all shadow-lg shadow-red-100">
                        Reject
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>