<aside class="bg-white dark:bg-gray-800 border-r border-gray-100 dark:border-gray-700 flex flex-col sticky top-0 h-screen">
    <div class="h-16 flex items-center mb-4 shrink-0 transition-all duration-300" :class="sidebarOpen ? 'px-6' : 'justify-center px-0'">

        <div class="flex items-center justify-center" :class="sidebarOpen ? '' : 'w-full'">
            <img src="{{ asset('images/hire-logo2.png') }}" alt="Logo" class="transition-all duration-300 shrink-0" :class="sidebarOpen ? 'h-8 w-auto' : 'h-10 w-10'">

            <span x-show="sidebarOpen" x-cloak class="ml-3 font-bold text-xl text-slate-900 whitespace-nowrap">
                Ryde
            </span>
        </div>
    </div>

    <nav class="flex-1 px-4 py-6 space-y-4">
        <x-nav-link href="{{ route('admin.dashboard') }}" active="{{ request()->routeIs('admin.dashboard') }}" class="overflow-hidden whitespace-nowrap">
            <div class="flex items-center min-w-[24px]"> <i data-lucide="layout-dashboard" class="w-6 h-6 shrink-0"></i>
            </div>
            <span x-show="sidebarOpen" x-cloak class="ml-3 font-medium transition-opacity duration-300">
                Dashboard
            </span>
        </x-nav-link>

        <x-nav-link href="{{ route('admin.vehicles') }}" active="{{ request()->routeIs('admin.vehicles') }}" class="overflow-hidden whitespace-nowrap">
            <div class="flex items-center min-w-[24px]"><i data-lucide="car-front" class="w-6 h-6 shrink-0"></i></div>
            <span x-show="sidebarOpen" x-cloak class="ml-3 font-medium transition-opacity duration-300">Vehicles</span>
        </x-nav-link>

        <x-nav-link href="{{ route('admin.bookings') }}" active="{{ request()->routeIs('admin.bookings') }}" class="overflow-hidden whitespace-nowrap">
            <div class="flex items-center min-w-[24px]"><i data-lucide="calendar" class="w-6 h-6 shrink-0"></i></div>
            <span x-show="sidebarOpen" x-cloak class="ml-3 font-medium transition-opacity duration-300">My Bookings</span>
        </x-nav-link>

        <x-nav-link href="{{ route('admin.settings') }}" active="{{ request()->routeIs('admin.settings') }}" class="overflow-hidden whitespace-nowrap">
            <div class="flex items-center min-w-[24px]"><i data-lucide="settings" class="w-6 h-6 shrink-0"></i></div>
            <span x-show="sidebarOpen" x-cloak class="ml-3 font-medium transition-opacity duration-300">Settings</span>
        </x-nav-link>
    </nav>

    <div class="p-4 border-t border-gray-100 dark:border-gray-700">
        <div x-show="sidebarOpen" x-cloak class="text-xs text-gray-400 text-center transition-opacity">
            © 2026 Ryde
        </div>
        <div x-show="!sidebarOpen" class="text-center text-gray-400 font-bold">R</div>
    </div>
</aside>
