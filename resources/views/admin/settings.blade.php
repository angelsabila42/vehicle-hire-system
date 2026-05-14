<x-app-layout>
    <div class="py-6 max-w-5xl mx-auto">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Settings</h1>
            <p class="text-gray-500 mt-1 font-medium">Manage your business settings and preferences</p>
        </div>

        <form action="#" method="POST" class="space-y-8">
            @csrf
            
            <div class="bg-white p-8 rounded-[2.5rem] border border-gray-100 shadow-sm">
                <div class="flex items-center gap-3 mb-8">
                    <div class="p-3 bg-slate-50 rounded-2xl">
                        <i data-lucide="building-2" class="w-6 h-6 text-slate-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900">Business Information</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label class="block text-sm font-bold text-slate-700 mb-2">Business Name</label>
                        <input type="text" value="Ryde" class="w-full px-5 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-slate-900 transition-all font-medium">
                    </div>
                    
                    <div class="md:col-span-2">
                        <label class="block text-sm font-bold text-slate-700 mb-2">Business Address</label>
                        <input type="text" value="Plot 45, Kampala Road, Kampala" class="w-full px-5 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-slate-900 transition-all font-medium">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Phone Number</label>
                        <input type="text" value="+256 700 000000" class="w-full px-5 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-slate-900 transition-all font-medium">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Email</label>
                        <input type="email" value="info@rydeug.com" class="w-full px-5 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-slate-900 transition-all font-medium">
                    </div>
                </div>
            </div>

            <div class="bg-white p-8 rounded-[2.5rem] border border-gray-100 shadow-sm">
                <div class="flex items-center gap-3 mb-8">
                    <div class="p-3 bg-slate-50 rounded-2xl">
                        <i data-lucide="banknote" class="w-6 h-6 text-slate-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900">Pricing & Policies</h3>
                </div>

                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Currency</label>
                        <select class="w-full px-5 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-slate-900 transition-all font-bold text-slate-700">
                            <option>UGX - Ugandan Shilling</option>
                            <option>USD - US Dollar</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Late Return Fee (per hour)</label>
                        <input type="text" value="10,000" class="w-full px-5 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-slate-900 transition-all font-medium">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Cancellation Policy</label>
                        <textarea rows="3" class="w-full px-5 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-slate-900 transition-all font-medium">Free cancellation up to 24 hours before pickup. Cancellations within 24 hours are subject to a 50% fee.</textarea>
                    </div>
                </div>
            </div>

            <div class="bg-white p-8 rounded-[2.5rem] border border-gray-100 shadow-sm">
                <div class="flex items-center gap-3 mb-8">
                    <div class="p-3 bg-slate-50 rounded-2xl">
                        <i data-lucide="bell" class="w-6 h-6 text-slate-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900">Notification Preferences</h3>
                </div>

                <div class="space-y-6">
                    @foreach([
                        ['title' => 'New Booking Notifications', 'desc' => 'Receive alerts when customers make new bookings', 'checked' => true],
                        ['title' => 'Booking Reminders', 'desc' => 'Get reminders for upcoming pickups and returns', 'checked' => true],
                        ['title' => 'Maintenance Alerts', 'desc' => 'Notifications for vehicle maintenance schedules', 'checked' => true],
                        ['title' => 'Email Notifications', 'desc' => 'Send email summaries daily', 'checked' => false],
                    ] as $notif)
                    <div class="flex items-center justify-between p-4 hover:bg-slate-50 rounded-2xl transition-colors">
                        <div>
                            <div class="font-bold text-slate-900 text-sm">{{ $notif['title'] }}</div>
                            <div class="text-xs text-gray-400 font-medium">{{ $notif['desc'] }}</div>
                        </div>
                        <input type="checkbox" {{ $notif['checked'] ? 'checked' : '' }} class="w-5 h-5 text-slate-900 border-gray-200 rounded-lg focus:ring-slate-900">
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="bg-white p-8 rounded-[2.5rem] border border-gray-100 shadow-sm">
                <div class="flex justify-between items-center mb-8">
                    <div class="flex items-center gap-3">
                        <div class="p-3 bg-slate-50 rounded-2xl">
                            <i data-lucide="map-pin" class="w-6 h-6 text-slate-600"></i>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900">Pickup Locations</h3>
                    </div>
                    <button type="button" class="px-6 py-3 bg-slate-900 text-white rounded-xl font-bold text-sm shadow-lg shadow-slate-200">
                        Add Location
                    </button>
                </div>

                <div class="space-y-3">
                    @foreach(['Kampala - City Center', 'Entebbe International Airport', 'Jinja - Main Office', 'Mbarara - Branch Office'] as $location)
                    <div class="flex items-center justify-between p-5 bg-slate-50 rounded-2xl group">
                        <div class="flex items-center gap-3 text-slate-700 font-bold text-sm">
                            <i data-lucide="map-pin" class="w-4 h-4 text-gray-400"></i>
                            {{ $location }}
                        </div>
                        <button type="button" class="text-red-500 text-xs font-extrabold uppercase tracking-tight opacity-0 group-hover:opacity-100 transition-opacity">Remove</button>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="flex justify-end pt-4 pb-12">
                <button type="submit" class="flex items-center gap-3 px-10 py-4 bg-slate-900 text-white rounded-2xl font-bold shadow-xl shadow-slate-200 hover:scale-[1.02] transition-all">
                    <i data-lucide="save" class="w-5 h-5"></i>
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</x-app-layout>