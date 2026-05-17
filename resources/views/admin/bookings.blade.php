<x-app-layout>
    <div class="py-6" x-data="bookingManager">
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
            <div>
                <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Booking Management</h1>
                <p class="text-gray-500 mt-1 font-medium">Review and manage customer bookings</p>
            </div>

        </div>

        <div class="flex items-center space-x-2 mb-8 bg-white p-2 rounded-2xl border border-gray-100 w-fit overflow-x-auto scrollbar-hide">
            <form method="GET" action="{{ route('admin.bookings') }}">
                @if($status)
                <input type="hidden" name="status" value="{{ $status }}">
                @endif
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <i data-lucide="search" class="w-5 h-5 text-gray-400 group-focus-within:text-slate-900 transition-colors"></i>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search bookings..." class="block w-full md:w-80 pl-11 pr-4 py-3 bg-white border border-gray-100 rounded-2xl text-sm font-medium focus:ring-2 focus:ring-slate-900 focus:border-transparent transition-all shadow-sm">
                </div>
            </form>
            
            <a href="{{ route('admin.bookings') }}" class="px-6 py-2 rounded-xl font-bold text-sm transition-all
               {{ !$status ? 'bg-slate-900 text-white shadow-lg shadow-slate-200' : 'text-gray-500 hover:bg-gray-50' }}">
                All
            </a>

            <a href="{{ route('admin.bookings', ['status' => 'Pending']) }}" class="px-6 py-2 rounded-xl font-bold text-sm transition-all
               {{ $status == 'Pending' ? 'bg-slate-900 text-white shadow-lg shadow-slate-200' : 'text-gray-500 hover:bg-gray-50' }}">
                Pending
            </a>

            <a href="{{ route('admin.bookings', ['status' => 'Confirmed']) }}" class="px-6 py-2 rounded-xl font-bold text-sm transition-all
               {{ $status == 'Confirmed' ? 'bg-slate-900 text-white shadow-lg shadow-slate-200' : 'text-gray-500 hover:bg-gray-50' }}">
                Confirmed
            </a>

            <a href="{{ route('admin.bookings', ['status' => 'Confirmed']) }}" class="px-6 py-2 rounded-xl font-bold text-sm transition-all
               {{ $status == 'Confirmed' ? 'bg-slate-900 text-white shadow-lg shadow-slate-200' : 'text-gray-500 hover:bg-gray-50' }}">
                Completed
            </a>

            <a href="{{ route('admin.bookings', ['status' => 'Rejected']) }}" class="px-6 py-2 rounded-xl font-bold text-sm transition-all
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
                    @forelse($bookings as $booking)
                    <tr class="hover:bg-gray-50/50 transition-colors group">
                        <td class="px-8 py-6 font-bold text-slate-900">#{{ $booking->id }}</td>
                        <td class="px-8 py-6">
                            <div class="text-sm font-extrabold text-slate-900">{{ $booking->user?->name ?? 'Unknown customer' }}</div>
                            <div class="text-xs text-gray-400 font-medium">{{ $booking->user?->email ?? '—' }}</div>
                        </td>
                        <td class="px-8 py-6">
                            <div class="text-sm font-bold text-slate-700">{{ $booking->vehicle ? trim($booking->vehicle->make . ' ' . $booking->vehicle->model) : 'Unknown vehicle' }}</div>
                            <div class="text-[10px] text-gray-400 font-bold uppercase mt-0.5">
                                {{ $booking->startDate ? \Carbon\Carbon::parse($booking->startDate)->format('M j, Y') : '—' }}
                                –
                                {{ $booking->endDate ? \Carbon\Carbon::parse($booking->endDate)->format('M j, Y') : '—' }}
                            </div>
                        </td>
                        <td class="px-8 py-6">
                            <span class="px-3 py-1.5 rounded-lg bg-amber-50 text-amber-600 text-[11px] font-extrabold tracking-tight">
                                {{ $booking->status }}
                            </span>
                        </td>
                        @php
                        $start = $booking->startDate ? \Carbon\Carbon::parse($booking->startDate) : null;
                        $end = $booking->endDate ? \Carbon\Carbon::parse($booking->endDate) : null;
                        $days = ($start && $end) ? max($start->diffInDays($end) + 1, 1) : 1;
                        $amount = $booking->vehicle ? $days * $booking->vehicle->price_per_day : 0;
                        $vehicleLabel = $booking->vehicle
                        ? trim($booking->vehicle->make . ' ' . $booking->vehicle->model)
                        : 'Unknown vehicle';
                        @endphp
                        <td class="px-8 py-6 text-sm font-extrabold text-slate-900">
                            <span class="text-[10px] text-gray-400 mr-1 uppercase">UGX</span>{{ number_format($amount) }}
                        </td>
                        <td class="px-8 py-6">
                            <div class="flex items-center justify-center gap-3">
                                <button @click="openBookingDrawer(@js([
                                    'id' => $booking->id,
                                    'customer_name' => $booking->user?->name ?? 'Unknown customer',
                                    'customer_email' => $booking->user?->email ?? '',
                                    'vehicle_name' => $vehicleLabel,
                                    'pickup_date' => $start?->format('M j, Y') ?? '',
                                    'location' => $booking->pickupLocation?->address ?? '',
                                    'status' => $booking->status,
                                    'amount' => number_format($amount),
                                ]))" class="p-2 text-gray-400 hover:text-slate-900 hover:bg-white rounded-xl transition-all shadow-sm border border-transparent hover:border-gray-100">
                                    <i data-lucide="eye" class="w-4 h-4"></i>
                                </button>
                                @if($booking->status === 'Pending')
                                <form action="{{ route('admin.bookings.approve', $booking->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="p-2 text-emerald-500 hover:bg-emerald-50 rounded-xl transition-all">
                                        <i data-lucide="check-circle" class="w-4 h-4"></i>
                                    </button>
                                </form>
                                <form action="{{ route('admin.bookings.reject', $booking->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="p-2 text-red-400 hover:bg-red-50 rounded-xl transition-all">
                                        <i data-lucide="x-circle" class="w-4 h-4"></i>
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-8 py-16 text-center text-gray-400 font-medium">
                            No bookings found{{ $status ? ' with status ' . $status : '' }}.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @include('admin.partials.booking-show-modal')
    </div>
</x-app-layout>
