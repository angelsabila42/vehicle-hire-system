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
                    Quality vehicles at your fingertips. Experience seamless car rental across Uganda with flexible terms and transparent pricing.
                </p>
                <div class="flex space-x-4">
                    <button class="bg-slate-900 text-white px-8 py-4 rounded-xl font-bold hover:bg-slate-800 transition flex items-center">
                        Browse Vehicles <i data-lucide="arrow-right" class="ml-2 w-5 h-5"></i>
                    </button>
                    <button class="bg-white text-slate-900 border border-gray-200 px-8 py-4 rounded-xl font-bold hover:bg-gray-50 transition">
                        Learn More
                    </button>
                </div>
            </div>
            <div class="absolute inset-0 opacity-[0.03] pointer-events-none" style="background-image: radial-gradient(#000 1px, transparent 1px); background-size: 20px 20px;"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 my-12">
            <div class="bg-white p-8 rounded-3xl border border-gray-50 shadow-sm text-center md:text-left">
                <div class="w-12 h-12 bg-slate-50 rounded-2xl flex items-center justify-center mb-6 mx-auto md:mx-0">
                    <i data-lucide="shield-check" class="text-slate-900 w-6 h-6"></i>
                </div>
                <h4 class="text-lg font-bold text-slate-900 mb-2">Fully Insured</h4>
                <p class="text-gray-400 text-sm leading-relaxed">All vehicles come with comprehensive insurance coverage</p>
            </div>

            <div class="bg-white p-8 rounded-3xl border border-gray-50 shadow-sm text-center md:text-left">
                <div class="w-12 h-12 bg-slate-50 rounded-2xl flex items-center justify-center mb-6 mx-auto md:mx-0">
                    <i data-lucide="clock" class="text-slate-900 w-6 h-6"></i>
                </div>
                <h4 class="text-lg font-bold text-slate-900 mb-2">24/7 Support</h4>
                <p class="text-gray-400 text-sm leading-relaxed">Round-the-clock customer support for your peace of mind</p>
            </div>

            <div class="bg-white p-8 rounded-3xl border border-gray-50 shadow-sm text-center md:text-left">
                <div class="w-12 h-12 bg-slate-50 rounded-2xl flex items-center justify-center mb-6 mx-auto md:mx-0">
                    <i data-lucide="star" class="text-slate-900 w-6 h-6"></i>
                </div>
                <h4 class="text-lg font-bold text-slate-900 mb-2">Top Quality</h4>
                <p class="text-gray-400 text-sm leading-relaxed">Well-maintained vehicles from trusted brands</p>
            </div>
        </div>

        <section class="py-12">
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h2 class="text-2xl font-bold text-slate-900">Featured Vehicles</h2>
                    <p class="text-gray-500">Popular choices for your next journey</p>
                </div>
                <a href="{{ route('customer.vehicles.index') }}" class="text-slate-900 font-bold flex items-center hover:underline">
                    View all <i data-lucide="arrow-right" class="ml-2 w-4 h-4"></i>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <a href="{{ route('customer.vehicles.show.details', 1) }}" class="group block bg-white rounded-[2rem] border border-gray-100 shadow-sm overflow-hidden hover:shadow-xl hover:-translate-y-2 transition-all duration-300">
                    <div class="relative h-64 overflow-hidden">
                        <img src="{{ asset('images/rav4.jpg') }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" alt="Toyota Rav4">
                        <div class="absolute bottom-4 right-4">
                            <span class="px-4 py-1.5 bg-white/90 backdrop-blur-md text-green-600 text-xs font-bold rounded-full shadow-sm">Available</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-2">
                            <div>
                                <h3 class="text-xl font-bold text-slate-900">Toyota Rav4</h3>
                                <p class="text-gray-400 text-sm">SUV</p>
                            </div>
                            <div class="flex items-center text-amber-400">
                                <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                                <span class="ml-1 text-slate-900 font-bold">4.9</span>
                            </div>
                        </div>
                        <div class="flex justify-between items-center mt-6 pt-6 border-t border-gray-50">
                            <div>
                                <p class="text-xs text-gray-400 font-bold uppercase tracking-tighter">Per day</p>
                                <p class="text-lg font-bold text-slate-900">UGX 120,000</p>
                            </div>
                            <div class="p-3 bg-slate-900 text-white rounded-2xl group-hover:bg-blue-600 transition-colors">
                                <i data-lucide="arrow-up-right" class="w-5 h-5"></i>
                            </div>
                        </div>
                    </div>
                </a>

                <a href="{{ route('customer.vehicles.show.details', 2) }}" class="group block bg-white rounded-[2rem] border border-gray-100 shadow-sm overflow-hidden hover:shadow-xl hover:-translate-y-2 transition-all duration-300">
                    <div class="relative h-64 overflow-hidden">
                        <img src="{{ asset('images/accord.jpg') }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" alt="Honda Accord">
                        <div class="absolute bottom-4 right-4">
                            <span class="px-4 py-1.5 bg-white/90 backdrop-blur-md text-green-600 text-xs font-bold rounded-full shadow-sm">Available</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-2">
                            <div>
                                <h3 class="text-xl font-bold text-slate-900">Honda Accord</h3>
                                <p class="text-gray-400 text-sm">Sedan</p>
                            </div>
                            <div class="flex items-center text-amber-400">
                                <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                                <span class="ml-1 text-slate-900 font-bold">4.8</span>
                            </div>
                        </div>
                        <div class="flex justify-between items-center mt-6 pt-6 border-t border-gray-50">
                            <div>
                                <p class="text-xs text-gray-400 font-bold uppercase tracking-tighter">Per day</p>
                                <p class="text-lg font-bold text-slate-900">UGX 80,000</p>
                            </div>
                            <div class="p-3 bg-slate-900 text-white rounded-2xl group-hover:bg-blue-600 transition-colors">
                                <i data-lucide="arrow-up-right" class="w-5 h-5"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </section>
    </div>
</x-app-layout>