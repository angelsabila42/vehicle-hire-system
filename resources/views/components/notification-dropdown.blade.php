<!-- Dropdown -->
<div x-show="open" x-cloak @click.away="open = false" 
    x-transition:enter="transition ease-out duration-200" 
    x-transition:enter-start="opacity-0 scale-95" 
    x-transition:enter-end="opacity-100 scale-100" 
    x-transition:leave="transition ease-in duration-150" 
    x-transition:leave-start="opacity-100 scale-100" 
    x-transition:leave-end="opacity-0 scale-95" 
    class="absolute right-0 mt-4 w-[420px] bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden z-50">

    <!-- Header -->
    <div class="flex items-start justify-between px-6 py-5 border-b">

        <div>
            <h2 class="text-2xl font-semibold text-gray-800">
                Notifications
            </h2>

            <p class="text-sm text-gray-500 mt-1">
                2 unread notifications
            </p>
        </div>

        <!-- Close Button -->
        <button @click="open = false" class="text-gray-400 hover:text-gray-700 transition">
             <i data-lucide="x" class="w-5 h-5"></i>
        </button>

    </div>

    <!-- Actions -->
    <div class="flex items-center justify-between px-6 py-4 border-b text-sm">

        <button class="text-gray-600 hover:text-blue-600 transition">
            Mark all as read
        </button>

        <button class="text-red-500 hover:text-red-700 transition">
            Clear all
        </button>

    </div>

    <!-- Notifications List -->
    <div class="max-h-[400px] overflow-y-auto">

        <!-- Notification Item -->
        <div class="flex gap-4 px-6 py-5 hover:bg-gray-50 transition border-b">

            <!-- Icon -->
            <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center shrink-0">

                <i data-lucide="clock-3" class="w-5 h-5 text-blue-600"></i>

            </div>

            <!-- Content -->
            <div class="flex-1">

                <div class="flex items-start justify-between">

                    <h4 class="font-medium text-gray-800">
                        Pickup Reminder
                    </h4>

                    <!-- Unread Dot -->
                    <span class="w-2 h-2 bg-blue-500 rounded-full mt-2"></span>

                </div>

                <p class="text-sm text-gray-500 mt-1 leading-relaxed">
                    Your vehicle pickup is scheduled for tomorrow
                </p>

                <span class="text-xs text-gray-400 mt-2 block">
                    2 hours ago
                </span>

            </div>

        </div>

        <!-- Notification Item -->
        <div class="flex gap-4 px-6 py-5 hover:bg-gray-50 transition border-b">

            <!-- Icon -->
            <div class="w-12 h-12 rounded-full bg-purple-100 flex items-center justify-center shrink-0">

                <i data-lucide="car-front" class="w-5 h-5 text-purple-600"></i>

            </div>

            <!-- Content -->
            <div class="flex-1">

                <h4 class="font-medium text-gray-800">
                    New Vehicles Available
                </h4>

                <p class="text-sm text-gray-500 mt-1 leading-relaxed">
                    Check out our latest addition: Land Cruiser V8
                </p>

                <span class="text-xs text-gray-400 mt-2 block">
                    1 day ago
                </span>

            </div>

        </div>

        <!-- Notification Item -->
        <div class="flex gap-4 px-6 py-5 hover:bg-gray-50 transition">

            <!-- Icon -->
            <div class="w-12 h-12 rounded-full bg-gray-100 flex items-center justify-center shrink-0">

                 <i data-lucide="user-round" class="w-5 h-5 text-gray-600"></i>

            </div>

            <!-- Content -->
            <div class="flex-1">

                <h4 class="font-medium text-gray-800">
                    Welcome to DriveUg
                </h4>

                <p class="text-sm text-gray-500 mt-1 leading-relaxed">
                    Complete your profile to get personalized recommendations
                </p>

                <span class="text-xs text-gray-400 mt-2 block">
                    3 days ago
                </span>

            </div>

        </div>

    </div>

</div>
