<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="px-6 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            @if(request()->is('admin*'))
            <div class="flex">
                <!-- Menu bar -->
                <div class="shrink-0 flex items-center">
                    <button @click="sidebarOpen = !sidebarOpen" class="p-2 rounded-md hover:bg-gray-100 transition-colors">
                        <i data-lucide="menu" class="w-6 h-6"></i>
                    </button>
                </div>
            </div>
            @endif

            @if(request()->is('admin*'))
            <!-- Search Bar -->
            <div class="flex-1 flex items-center justify-center px-4">
                <div class="w-full max-w-md relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
                        <i data-lucide="search" class="w-4 h-4 text-gray-400"></i>
                    </span>
                    <input type="text" class="w-full bg-gray-100 border-none rounded-full pl-10 text-sm focus:ring-slate-900" placeholder="Search vehicles or users...">
                </div>
            </div>


            <!-- Notification Bell -->
            <div class="flex items-center space-x-4">
                <button class="relative p-2 text-gray-400 hover:text-gray-600 transition-colors">
                    <i data-lucide="bell" class="w-5 h-5"></i>
                    <span class="absolute top-1 right-1 block h-2 w-2 rounded-full bg-red-500 ring-2 ring-white"></span>
                </button>

                <x-dropdown align="right" width="48">
                    <!-- Profile -->
                    <x-slot name="trigger">
                        <button class="flex items-center transition focus:outline-none">
                            <div class="relative">
                                <img class="h-10 w-10 rounded-full object-cover border-2 border-transparent hover:border-slate-900" src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=0D1B2A&color=fff" alt="Admin">
                            </div>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">Profile</x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">Log Out</x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
            @else
            <!-- Logo -->
            <div class="flex items-center w-64">

                <div class="flex items-center">
                    <img src="{{ asset('images/hire-logo2.png') }}" alt="Logo" class="shrink-0 h-10 w-10">

                    <span class="ml-3 font-bold text-xl text-slate-900 whitespace-nowrap">
                        Ryde
                    </span>
                </div>
            </div>

            <!-- Navigation Links -->
            <div class="flex-1 flex items-center justify-center space-x-8">


                <a href="{{ route('dashboard') }}" class="flex items-center gap-2 px-6 py-2 rounded-xl font-bold transition-all duration-200 
                    {{ request()->routeIs('dashboard') 
                    ? 'bg-gray-100 text-slate-900 shadow-sm' 
                    : 'text-gray-400 hover:bg-slate-100 hover:text-slate-900' 
                }}">
                    <i data-lucide="home" class="w-4 h-4"></i>
                    <span>Home</span>
                </a>

                <a href="{{ route('customer.vehicles.index') }}" class="flex items-center gap-2 px-6 py-2 rounded-xl font-bold transition-all duration-200 
                    {{ request()->routeIs('customer.vehicles.index') 
                    ? 'bg-gray-100 text-slate-900 shadow-sm' 
                    : 'text-gray-400 hover:bg-slate-100 hover:text-slate-900' 
                }}">
                    <i data-lucide="car-front" class="w-4 h-4"></i>
                    <span>Vehicles</span>
                </a>

                <a href="{{ route('customer.bookings') }}" class="flex items-center gap-2 px-6 py-2 rounded-xl font-bold transition-all duration-200 
                    {{ request()->routeIs('customer.bookings') 
                    ? 'bg-gray-100 text-slate-900 shadow-sm' 
                    : 'text-gray-400 hover:bg-slate-100 hover:text-slate-900' 
                }}">
                    <i data-lucide="calendar" class="w-4 h-4"></i>
                    <span>Bookings</span>
                </a> 

            </div>

            <div class="flex items-center justify-end w-64 space-x-4">
                <!-- Profile -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center space-x-3 focus:outline-none group">
                            <div class="text-right hidden sm:block">
                                <p class="text-sm font-semibold text-slate-900 leading-none">{{ Auth::user()->name }}</p>
                            </div>
                            <img class="h-10 w-10 rounded-full border-2 border-transparent group-hover:border-slate-900 transition-all" src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=f1f5f9&color=0f172a" alt="Avatar">
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">My Profile</x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">Log Out</x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
            @endif



            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
