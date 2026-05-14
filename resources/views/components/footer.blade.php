<!-- resources/views/components/footer.blade.php -->
<footer class="bg-white border-t border-gray-100 py-12">
    <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Logo Section -->
        <div>
            <div class="flex items-center gap-2 mb-4">
                <img src="{{ asset('images/hire-logo2.png') }}" alt="Logo" class="h-10 w-10">
                <span class="text-xl font-bold text-slate-900 tracking-tight">Ryde</span>
            </div>
            <p class="text-gray-500 text-sm leading-relaxed max-w-xs">
                Your trusted vehicle hire service in Uganda. Reliable, affordable, and convenient car rentals for every journey.
            </p>
        </div>

        <!-- Navigation Links -->
        <div class="grid grid-cols-2 gap-8 md:col-span-2">
            <div>
                <h4 class="font-bold text-slate-900 mb-4">Company</h4>
                <ul class="space-y-3 text-sm text-gray-500 font-medium">
                    <li><a href="#" class="hover:text-slate-900 transition-colors">About Us</a></li>
                    <li><a href="#" class="hover:text-slate-900 transition-colors">Contact</a></li>
                    <li><a href="#" class="hover:text-slate-900 transition-colors">Careers</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold text-slate-900 mb-4">Support</h4>
                <ul class="space-y-3 text-sm text-gray-500 font-medium">
                    <li><a href="#" class="hover:text-slate-900 transition-colors">Help Center</a></li>
                    <li><a href="#" class="hover:text-slate-900 transition-colors">Terms of Service</a></li>
                    <li><a href="#" class="hover:text-slate-900 transition-colors">Privacy Policy</a></li>
                </ul>
            </div>
        </div>
    </div>
    
    <!-- Bottom Bar -->
    <div class="mt-12 pt-8 border-t border-gray-50 text-center">
        <p class="text-gray-400 text-[10px] font-extrabold uppercase tracking-[0.2em]">
            &copy; {{ date('Y') }} Ryde. All rights reserved.
        </p>
    </div>
</footer>