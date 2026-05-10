<x-app-layout>
    <div class="py-6">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-slate-900">Booking Management</h1>
            <p class="text-gray-500 mt-1">Review and manage customer bookings</p>
        </div>

        <div class="flex items-center space-x-2 mb-6 bg-white p-2 rounded-2xl border border-gray-100 w-fit">
            <button class="px-6 py-2 rounded-xl bg-slate-900 text-white font-medium text-sm">All</button>
            <button class="px-6 py-2 rounded-xl text-gray-500 hover:bg-gray-50 font-medium text-sm">Pending</button>
            <button class="px-6 py-2 rounded-xl text-gray-500 hover:bg-gray-50 font-medium text-sm">Confirmed</button>
            <button class="px-6 py-2 rounded-xl text-gray-500 hover:bg-gray-50 font-medium text-sm">Completed</button>
        </div>

        <div class="bg-white rounded-3xl border border-gray-100 overflow-hidden shadow-sm">
            <table class="w-full text-left">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase">Booking ID</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase">Customer</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase">Vehicle</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase">Pickup Date</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase">Location</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    <tr class="hover:bg-gray-50/50 transition">
                        <td class="px-6 py-6 font-medium text-slate-900">#1</td>
                        <td class="px-6 py-6">
                            <div class="text-sm font-bold text-slate-900">John Kamau</div>
                            <div class="text-xs text-gray-400">john.kamau@email.com</div>
                        </td>
                        <td class="px-6 py-6 text-sm text-gray-600 font-medium">Toyota Rav4</td>
                        <td class="px-6 py-6 text-sm text-gray-600">5/10/2026</td>
                        <td class="px-6 py-6 text-sm text-gray-400">Kampala - City Center</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
