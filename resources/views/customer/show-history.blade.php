<x-app-layout>
    <div class="py-6 max-w-5xl mx-auto space-y-6">
    <!-- Header -->
        <div class="flex flex-col space-y-4">
            <a href="{{ route('customer.bookings') }}" class="flex items-center text-gray-500 hover:text-slate-900 transition text-sm font-medium">
                <i data-lucide="arrow-left" class="mr-2 w-4 h-4"></i> Back to bookings
            </a>

<!-- Booking Details -->
            <div class="flex justify-between items-start">
                <div>
                    <h1 class="text-3xl text-slate-900">Booking Details</h1>
                    <p class="text-gray-400 mt-1">Booking #1</p>
                </div>
                <span class="px-4 py-1.5 bg-green-50 text-green-600 rounded-full border border-green-100 flex items-center text-sm">
                    <i data-lucide="check-circle" class="w-4 h-4 mr-2"></i> Confirmed
                </span>
            </div>
        </div>

        <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">

            <div class="p-8 space-y-10">
            <!-- Vehicle Information -->
                <section>
                    <h2 class="text-sm font-bold tracking-widest mb-6 flex items-center">
                        <i data-lucide="car" class="mr-2 w-4 h-4"></i> Vehicle Information
                    </h2>
                    <div class="flex items-center">
                        <img src="{{ asset('images/rav4.jpg') }}" class="w-32 h-20 object-cover rounded-xl mr-6" alt="Car">
                        <div>
                            <h3 class="text-lg font-bold text-slate-900">Toyota Rav4</h3>
                            <p class="text-gray-400 text-sm">SUV</p>
                            <p class="text-sm font-medium text-slate-500 mt-1">Daily Rate: <span class="text-slate-900">UGX 120,000</span></p>
                        </div>
                    </div>
                </section>

<!-- Rental Details -->
                <section>
                    <h2 class="text-sm font-bold tracking-widest mb-6 flex items-center">
                        <i data-lucide="calendar" class="mr-2 w-4 h-4"></i> Rental Details
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="bg-gray-50 p-5 rounded-2xl">
                            <p class="text-xs text-gray-400 font-bold uppercase mb-1">Pickup Date</p>
                            <p class="font-semibold text-slate-700">Sunday, May 10, 2026</p>
                        </div>
                        <div class="bg-gray-50 p-5 rounded-2xl">
                            <p class="text-xs text-gray-400 font-bold uppercase mb-1">Return Date</p>
                            <p class="font-semibold text-slate-700">Friday, May 15, 2026</p>
                        </div>
                        <div class="bg-gray-50 p-5 rounded-2xl">
                            <p class="text-xs text-gray-400 font-bold uppercase mb-1">Pickup Location</p>
                            <div class="flex items-center font-semibold text-slate-700">
                                <i data-lucide="map-pin" class="w-4 h-4 mr-2 text-gray-400"></i> Kampala - City Center
                            </div>
                        </div>
                        <div class="bg-gray-50 p-5 rounded-2xl">
                            <p class="text-xs text-gray-400 font-bold uppercase mb-1">Rental Duration</p>
                            <p class="font-semibold text-slate-700">5 days</p>
                        </div>
                    </div>
                </section>

<!-- Customer Information -->
                <section class="bg-white border border-gray-100 rounded-3xl p-8">
                    <h2 class="text-sm font-bold tracking-widest mb-6 flex items-center">
                        <i data-lucide="user" class="mr-2 w-4 h-4"></i> Customer Information
                    </h2>
                    <div class="grid grid-cols-1 gap-y-4">
                        <div class="flex items-center"><i data-lucide="user" class="w-4 h-4 text-gray-400 mr-4"></i> <span class="text-gray-500 w-32">Full Name:</span> <span class="font-semibold">John Doe</span></div>
                        <div class="flex items-center"><i data-lucide="mail" class="w-4 h-4 text-gray-400 mr-4"></i> <span class="text-gray-500 w-32">Email:</span> <span class="font-semibold">john.doe@email.com</span></div>
                        <div class="flex items-center"><i data-lucide="phone" class="w-4 h-4 text-gray-400 mr-4"></i> <span class="text-gray-500 w-32">Phone:</span> <span class="font-semibold">+256 700 123456</span></div>
                        <div class="flex items-center"><i data-lucide="info" class="w-4 h-4 text-gray-400 mr-4"></i> <span class="text-gray-500 w-32">ID Number:</span> <span class="font-semibold">CM1234567890</span></div>
                    </div>
                </section>

<!-- Booking Timeline -->
                <section>
                    <h2 class="text-sm font-bold tracking-widest mb-8">Booking Timeline</h2>
                    <div class="space-y-8 relative before:absolute before:inset-y-0 before:left-5 before:w-px before:bg-gray-100">
                        <div class="relative flex items-start">
                            <div class="absolute left-0 w-10 h-10 bg-green-50 rounded-full border-4 border-white flex items-center justify-center">
                                <i data-lucide="check" class="w-4 h-4 text-green-600"></i>
                            </div>
                            <div class="ml-16">
                                <p class="font-bold text-slate-900 leading-none">Booking Created</p>
                                <p class="text-sm text-gray-500 mt-1">Your booking request has been submitted</p>
                                <p class="text-xs text-gray-400 mt-1">5/5/2026</p>
                            </div>
                        </div>
                    </div>
                </section>

<!-- Price Summary & Important Info -->
                <section class="space-y-4 pt-6">
                    <h2 class="text-xl font-bold text-slate-900">Price Summary</h2>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">Base rate (UGX 120,000 × 5 days)</span>
                        <span class="font-bold text-slate-900">UGX 600,000</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">Insurance</span>
                        <span class="text-green-600 font-medium">Included</span>
                    </div>
                    <div class="flex justify-between text-2xl font-bold pt-6 border-t border-gray-100">
                        <span>Total Amount</span>
                        <span>UGX 600,000</span>
                    </div>
                </section>

                <div class="bg-blue-50 rounded-2xl p-6 border border-blue-100">
                    <h4 class="text-blue-800 font-bold mb-3">Important Information</h4>
                    <ul class="text-blue-700 text-sm space-y-2 list-disc list-inside">
                        <li>Please bring your ID and driver's license</li>
                        <li>Arrive 15 minutes before pickup time</li>
                        <li>Payment due at pickup location</li>
                    </ul>
                </div>

                <button class="w-full py-4 bg-red-50 text-red-600 font-bold rounded-2xl hover:bg-red-100 transition border border-red-100">
                    Cancel Booking
                </button>
            </div>
        </div>
    </div>
</x-app-layout>
