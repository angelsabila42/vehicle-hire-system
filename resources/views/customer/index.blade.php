<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="bg-white rounded-3xl p-12 mb-8 border border-gray-100 shadow-sm relative overflow-hidden">
            <div class="max-w-2xl relative z-10">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 mb-4">
                    <span class="h-2 w-2 rounded-full bg-green-500 mr-2"></span>
                    Available for immediate booking
                </span>
                <h1 class="text-5xl font-extrabold text-slate-900 leading-tight mb-4">
                    Find Your Perfect Ride
                </h1>
                <p class="text-xl text-gray-500 mb-8">
                    Quality vehicles at your fingertips. Experience seamless car rental across Uganda.
                </p>
                <div class="flex space-x-4">
                    <button class="bg-slate-900 text-white px-8 py-4 rounded-xl font-bold hover:bg-slate-800 transition">
                        Browse Vehicles
                    </button>
                </div>
            </div>
            <div class="absolute inset-0 opacity-[0.03] pointer-events-none" style="background-image: radial-gradient(#000 1px, transparent 1px); background-size: 20px 20px;"></div>
        </div>
    </div>
</x-app-layout>