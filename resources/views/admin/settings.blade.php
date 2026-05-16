<x-app-layout>
    <div class="py-6 max-w-5xl mx-auto">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Settings</h1>
            <p class="text-gray-500 mt-1 font-medium">Manage your business settings and preferences</p>
        </div>

        <form action="{{ route('admin.settings.update') }}" method="POST" class="space-y-8">
            @csrf
            @method('PATCH')

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
                        <input type="text" name="business_name" value="{{ auth()->user()->business_name ?? 'Ryde' }}" class="w-full px-5 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-slate-900 transition-all font-medium">
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-bold text-slate-700 mb-2">Business Address</label>
                        <input type="text" name="address" value="{{ auth()->user()->address ?? 'Plot 45, Kampala Road, Kampala' }}" class="w-full px-5 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-slate-900 transition-all font-medium">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Phone Number</label>
                        <input type="text" name="phone" value="{{ auth()->user()->phone ?? '+256 700 000000' }}" class="w-full px-5 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-slate-900 transition-all font-medium">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Email</label>
                        <input type="email" name="email" value="{{ auth()->user()->email }}" class="w-full px-5 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-slate-900 transition-all font-medium">
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
                    @php
                    $settings = [
                    ['id'=> 'notify_new_bookings', 'title' => 'New Booking Notifications', 'desc' => 'Receive alerts for new bookings'],
                    ['id'=> 'notify_booking_cancelled', 'title' => 'Booking Cancellations', 'desc' => 'Notifications for cancellations'],
                    ['id'=> 'notify_booking_pending', 'title' => 'Booking Pending', 'desc' => 'Alerts when bookings are pending'],
                    ];
                    @endphp

                    @foreach($settings as $notif)
                    <div class="flex items-center justify-between p-4 hover:bg-slate-50 rounded-2xl transition-colors">
                        <div>
                            <div class="font-bold text-slate-900 text-sm">{{ $notif['title'] }}</div>
                            <div class="text-xs text-gray-400 font-medium">{{ $notif['desc'] }}</div>
                        </div>
                        <input type="checkbox" name="{{ $notif['id'] }}" @checked(auth()->user()->{$notif['id']}) class="w-5 h-5 text-slate-900 border-gray-200 rounded-lg focus:ring-slate-900">
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="bg-white p-8 rounded-[2.5rem] border border-gray-100 shadow-sm" x-data="{ showNewInput: false }">
                <div class="flex justify-between items-center mb-8">
                    <div class="flex items-center gap-3">
                        <div class="p-3 bg-slate-50 rounded-2xl">
                            <i data-lucide="map-pin" class="w-6 h-6 text-slate-600"></i>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900">Pickup Locations</h3>
                    </div>
                    <button type="button" @click="showNewInput = !showNewInput" class="px-6 py-3 bg-slate-900 text-white rounded-xl font-bold text-sm shadow-lg shadow-slate-200 hover:bg-slate-800 transition-all">
                        <span x-text="showNewInput ? 'Cancel' : 'Add Location'"></span>
                    </button>
                </div>

                <div class="space-y-3">
                    @foreach($locations as $location)
                    <div class="flex items-center justify-between p-5 bg-slate-50 rounded-2xl group">
                        <div class="flex items-center gap-3 text-slate-700 font-bold text-sm">
                            <i data-lucide="map-pin" class="w-4 h-4 text-gray-400"></i>
                            {{ $location->address }}
                        </div>
                        <div class="flex items-center">
                            <button type="button" onclick="if(confirm('Remove this location?')) document.getElementById('delete-loc-{{ $location->id }}').submit();" class="text-red-500 text-xs font-extrabold uppercase tracking-tight opacity-0 group-hover:opacity-100 transition-opacity hover:underline">
                                Remove
                            </button>
                        </div>
                    </div>
                    @endforeach

                    <div x-show="showNewInput" x-transition class="p-5 border-2 border-dashed border-slate-200 rounded-2xl bg-slate-50/50">
                        <div class="flex items-center justify-between">
                            <div class="flex-1 mr-4">
                                <label class="block text-xs font-bold text-slate-400 uppercase mb-2">New Location Address</label>
                                <input type="text" name="new_location_address" placeholder="e.g. Gulu - Northern Branch" class="w-full bg-white border-none rounded-xl focus:ring-2 focus:ring-slate-900 font-medium">
                            </div>
                            <div class="flex flex-col items-center">
                                <label class="text-[10px] font-bold text-slate-400 uppercase mb-1">Active</label>
                                <input type="checkbox" checked disabled class="w-5 h-5 text-slate-900 border-gray-200 rounded-lg">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>

    <div class="flex justify-end pt-4 pb-12">
        <button type="submit" class="flex items-center gap-3 px-10 py-4 bg-slate-900 text-white rounded-2xl font-bold shadow-xl shadow-slate-200 hover:scale-[1.02] transition-all active:scale-95">
            <i data-lucide="save" class="w-5 h-5"></i>
            Save All Changes
        </button>
    </div>
    </form>
    @foreach($locations as $location)
    <form id="delete-loc-{{ $location->id }}" action="{{ route('admin.locations.destroy', $location->id) }}" method="POST" class="hidden">
        @csrf
        @method('DELETE')
    </form>
    @endforeach
    </div>
</x-app-layout>
