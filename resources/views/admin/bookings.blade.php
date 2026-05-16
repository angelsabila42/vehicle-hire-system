<x-app-layout>
    <div class="py-6" x-data ="bookingManager">
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
            <div>
                <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Booking Management</h1>
                <p class="text-gray-500 mt-1 font-medium">Review and manage customer bookings</p>
            </div>
            <form method="GET" action="{{ route('admin.bookings') }}">
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <i data-lucide="search" class="w-5 h-5 text-gray-400 group-focus-within:text-slate-900 transition-colors"></i>
                </div>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search bookings..." class="block w-full md:w-80 pl-11 pr-4 py-3 bg-white border border-gray-100 rounded-2xl text-sm font-medium focus:ring-2 focus:ring-slate-900 focus:border-transparent transition-all shadow-sm">
            </div>
        </form>
        </div>

        <div class="flex items-center space-x-2 mb-8 bg-white p-2 rounded-2xl border border-gray-100 w-fit overflow-x-auto scrollbar-hide">
            <a href="{{ route('admin.bookings') }}"
               class="px-6 py-2 rounded-xl font-bold text-sm transition-all
               {{ !$status ? 'bg-slate-900 text-white shadow-lg shadow-slate-200' : 'text-gray-500 hover:bg-gray-50' }}">
               All
            </a>

            <a href="{{ route('admin.bookings', ['status' => 'Pending']) }}"
               class="px-6 py-2 rounded-xl font-bold text-sm transition-all
               {{ $status == 'Pending' ? 'bg-slate-900 text-white shadow-lg shadow-slate-200' : 'text-gray-500 hover:bg-gray-50' }}">
               Pending
            </a>

            <a href="{{ route('admin.bookings', ['status' => 'Confirmed']) }}"
               class="px-6 py-2 rounded-xl font-bold text-sm transition-all
               {{ $status == 'Confirmed' ? 'bg-slate-900 text-white shadow-lg shadow-slate-200' : 'text-gray-500 hover:bg-gray-50' }}">
               Confirmed
            </a>

            <a href="{{ route('admin.bookings', ['status' => 'Confirmed']) }}"
               class="px-6 py-2 rounded-xl font-bold text-sm transition-all
               {{ $status == 'Confirmed' ? 'bg-slate-900 text-white shadow-lg shadow-slate-200' : 'text-gray-500 hover:bg-gray-50' }}">
               Completed
            </a>

            <a href="{{ route('admin.bookings', ['status' => 'Rejected']) }}"
              class="px-6 py-2 rounded-xl font-bold text-sm transition-all
              {{ $status == 'Rejected' ? 'bg-slate-900 text-white shadow-lg shadow-slate-200' : 'text-gray-500 hover:bg-gray-50' }}">
              Cancelled
            </a>
        </div>

        <div class="bg-white rounded-[1.5rem] border border-gray-100 overflow-hidden shadow-sm">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-50/50 border-b border-gray-100">
                    <tr>
                        <th class="px-8 py-5 text-[11px] font-extrabold text-gray-400 uppercase tracking-widest">Booking ID</th>
                        <th class="px-8 py-5 text-[11px] font-extrabold text-gray-400 uppercase tracking-widest">Customer</th>
                        <th class="px-8 py-5 text-[11px] font-extrabold text-gray-400 uppercase tracking-widest">Vehicle</th>
                        <th class="px-8 py-5 text-[11px] font-extrabold text-gray-400 uppercase tracking-widest">Status</th>
                        <th class="px-8 py-5 text-[11px] font-extrabold text-gray-400 uppercase tracking-widest">Amount</th>
                        <th class="px-8 py-5 text-[11px] font-extrabold text-gray-400 uppercase tracking-widest text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach($bookings as $booking)
                    <tr class="hover:bg-gray-50/50 transition-colors group">
                        <td class="px-8 py-6 font-bold text-slate-900">#{{ $booking->id }}</td>
                        <td class="px-8 py-6">
                            <div class="text-sm font-extrabold text-slate-900">{{ $booking->user->name }}</div>
                            <div class="text-xs text-gray-400 font-medium">{{ $booking->user->email }}</div>
                        </td>
                        <td class="px-8 py-6">
                            <div class="text-sm font-bold text-slate-700">{{ $booking->vehicle->name }}</div>
                            <div class="text-[10px] text-gray-400 font-bold uppercase mt-0.5">{{ $booking->pickup_date }}</div>
                        </td>
                        <td class="px-8 py-6">
                            <span class="px-3 py-1.5 rounded-lg bg-amber-50 text-amber-600 text-[11px] font-extrabold tracking-tight">
                                {{ $booking->status }}
                            </span>
                        </td>
                        <td class="px-8 py-6 text-sm font-extrabold text-slate-900">
                            <span class="text-[10px] text-gray-400 mr-1 uppercase">UGX</span>600,000
                        </td>
                        <td class="px-8 py-6">
                            <div class="flex items-center justify-center gap-3">
                                <!--Change this once you have mock data or have connected the database-->
                                <button @click="openBookingDrawer({
                                    id: {{ $booking->id }}, 
                                    customer_name: '{{ $booking->user->name }}', 
                                    customer_email: '{{ $booking->user->email }}',
                                    vehicle_name: '{{ $booking->vehicle->name }}',
                                    pickup_date: '{{ $booking->pickup_date }}',
                                    location: '{{ $booking->location }}',
                                    status: '{{ $booking->status }}',
                                    amount: '{{ $booking->payment }}'
                                    })" class="p-2 text-gray-400 hover:text-slate-900 hover:bg-white rounded-xl transition-all shadow-sm border border-transparent hover:border-gray-100">
                                    <i data-lucide="eye" class="w-4 h-4"></i>
                                </button>
                                <form action="{{ route('admin.bookings.approve', $booking->id) }}" method="POST">
                                @csrf
                                    <button type="submit"
                                        class="p-2 text-emerald-500 hover:bg-emerald-50 rounded-xl transition-all">
                                        <i data-lucide="check-circle" class="w-4 h-4"></i>
                                    </button>
                                </form>
                                <form action="{{ route('admin.bookings.reject', $booking->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="p-2 text-red-400 hover:bg-red-50 rounded-xl transition-all">
                                        <i data-lucide="x-circle" class="w-4 h-4"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @include('admin.partials.booking-show-modal')
    </div>
</x-app-layout>
