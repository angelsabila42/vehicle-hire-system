<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-slate-900">Dashboard</h1>
            <p class="text-gray-500 mt-1">Welcome back! Here's what's happening today.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <x-stats-card title="Total Vehicles" value="24" trend="+2 this month" icon="car" color="blue" />
            <x-stats-card title="Available Vehicles" value="16" trend="Ready to rent" icon="check-circle" color="green" />
            <x-stats-card title="Active Bookings" value="8" trend="3 ending today" icon="clock" color="yellow" />
            <x-stats-card title="Pending Requests" value="6" trend="Action required" icon="calendar" color="purple" />
        </div>
    </div>
</x-app-layout>