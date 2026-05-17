<!-- Dropdown -->
<div x-show="open" x-cloak @click.away="open = false" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="absolute right-0 mt-4 w-[420px] bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden z-50">

    <!-- Header -->
    <div class="flex items-start justify-between px-6 py-5 border-b">

        <div>
            <h2 class="text-2xl font-semibold text-gray-800">
                Notifications
            </h2>

            <p class="text-sm text-gray-500 mt-1">
                @if($notifications->count())
                {{ auth()->user()->unreadNotifications->count() }} unread notifications
                @endif
            </p>
        </div>

        <button @click="open = false" class="text-gray-400 hover:text-gray-700 transition">
            <i data-lucide="x" class="w-5 h-5"></i>
        </button>

    </div>

    <!-- Actions -->
    <div class="flex items-center justify-between px-6 py-4 border-b text-sm">

        <!-- Mark all as read -->
        <form method="POST" action="{{ route('notifications.readAll') }}">
            @csrf
            <button class="text-gray-600 hover:text-blue-600 transition">
                Mark all as read
            </button>
        </form>

        <!-- Clear all -->
        <form method="POST" action="{{ route('notifications.clear') }}">
            @csrf
            @method('DELETE')
            <button class="text-red-500 hover:text-red-700 transition">
                Clear all
            </button>
        </form>

    </div>

    <!-- Notifications List -->
    <div class="max-h-[400px] overflow-y-auto">

        @if($notifications->count())

        @foreach($notifications as $notification)

        <!-- Notification Item -->
        <div class="flex gap-4 px-6 py-5 hover:bg-gray-50 transition group relative">

            <!-- Delete Button -->
            <form method="POST" action="{{ route('notifications.delete', $notification->id) }}" class="absolute right-4 top-4 opacity-0 group-hover:opacity-100 transition">

                @csrf
                @method('DELETE')

                <button type="submit" class="p-1 rounded-md text-red-500 hover:bg-red-100 transition">
                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                </button>

            </form>

            <!-- Icon -->
            <div class="w-12 h-12 rounded-full 
                        {{ $notification->data['bg_color'] ?? 'bg-gray-100' }} 
                        flex items-center justify-center shrink-0">

                <i data-lucide="{{ $notification->data['icon'] ?? 'bell' }}" class="w-5 h-5 {{ $notification->data['icon_color'] ?? 'text-gray-600' }}"></i>

            </div>

            <!-- Content (clickable) -->
            <a href="{{ route('notifications.read', $notification->id) }}" class="flex-1">

                <!-- Title + unread dot -->
                <div class="flex items-start justify-between">

                    <h4 class="font-medium text-gray-800">
                        {{ $notification->data['title'] ?? 'Notification' }}
                    </h4>



                </div>

                <!-- Message -->
                <p class="text-sm text-gray-500 mt-1 leading-relaxed">
                    {{ $notification->data['message'] ?? 'You have a notification' }}
                </p>

                <!-- Time -->
                <div class="flex items-start justify-between">
                    <span class="text-xs text-gray-400 mt-2 block">
                        {{ $notification->created_at->diffForHumans() }}
                    </span>
                    @if(is_null($notification->read_at))
                    <span class="w-2 h-2 bg-blue-500 rounded-full mt-1"></span>
                    @endif
                </div>

            </a>

        </div>

        @endforeach

        @else

        <!-- Empty State -->
        <div class="px-6 py-8 flex flex-col items-center text-gray-500 space-y-2">
            <i data-lucide="bell" class="w-8 h-8 text-gray-400"></i>
            <p>No notifications yet</p>
        </div>

        @endif

    </div>

</div>
