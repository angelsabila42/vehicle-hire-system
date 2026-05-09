@props(['header'])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        [x-cloak] {
            display: none !important;
        }

    </style>
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="font-sans antialiased">
    <div x-data="{ sidebarOpen: true }" class="min-h-screen bg-gray-100 dark:bg-gray-900 flex">

        @if(request()->is('admin*'))
        <aside :class="sidebarOpen ? 'w-64' : 'w-20'" class="transition-all duration-300 bg-white border-r h-screen sticky top-0 flex flex-col overflow-x-hidden">
            @include('layouts.sidebar')
        </aside>
        @endif

        <div class="flex-1 flex flex-col h-screen overflow-y-auto">

            @include('layouts.navigation')

            @if (isset($header))
            <header class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
            @endif

            <main class="p-6 overflow-y-auto">
                {{ $slot }}
            </main>

        </div>
    </div>
</body>
</html>