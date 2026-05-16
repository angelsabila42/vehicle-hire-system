<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ryde — Premium Vehicle Hire Service</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    
    <style>
        @keyframes pulseCircle {
            0%, 100% { 
                opacity: 0.1; 
                transform: scale(0.6); 
            }
            50% { 
                opacity: 0.6; 
                transform: scale(1.3); 
            }
        }
        .animate-pulse-1 {
            animation: pulseCircle 5s ease-in-out infinite;
        }
        .animate-pulse-2 {
            animation: pulseCircle 7s ease-in-out infinite;
            animation-delay: 1.5s;
        }
        .animate-pulse-3 {
            animation: pulseCircle 6s ease-in-out infinite;
            animation-delay: 3s;
        }
    </style>
</head>
<body class="bg-slate-50 font-sans antialiased selection:bg-violet-600 selection:text-white overflow-hidden">

    <nav class="absolute top-0 left-0 right-0 z-50 py-6 px-8 max-w-7xl mx-auto flex justify-between items-center">
        <div class="flex items-center gap-2">
            <img src="{{ asset('images/hire-logo2.png') }}" alt="Logo" class="h-10 w-10">
            <span class="text-xl font-bold text-slate-900 tracking-tight">Ryde</span>
        </div>

        <div class="flex items-center gap-6">
            @if (Route::has('login'))
                               
                <a href="{{ route('login') }}" class="text-sm font-bold text-violet-600 hover:text-violet-700 transition-colors">Log in</a>
                
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="px-5 py-2.5 bg-slate-900 text-white text-sm font-bold rounded-xl shadow-lg shadow-slate-200 hover:bg-slate-800 hover:scale-[1.02] transition-all">Sign Up</a>
                @endif
            @endif
        </div>
    </nav>

    <main class="relative min-h-screen flex items-center justify-center overflow-hidden bg-white">
        <div class="absolute inset-0 bg-[linear-gradient(to_right,#f1f5f9_1px,transparent_1px),linear-gradient(to_bottom,#f1f5f9_1px,transparent_1px)] bg-[size:4rem_4rem] [mask-image:radial-gradient(ellipse_60%_50%_at_50%_50%,#000_70%,transparent_100%)]"></div>

        <div class="absolute top-1/3 left-[22%] w-4 h-4 bg-violet-500 rounded-full blur-[1px] animate-pulse-1"></div>
        <div class="absolute bottom-1/3 right-[22%] w-3 h-3 bg-fuchsia-400 rounded-full blur-[1px] animate-pulse-2"></div>
        <div class="absolute top-1/4 right-1/3 w-2.5 h-2.5 bg-indigo-500 rounded-full blur-[1px] animate-pulse-3"></div>

        <div class="relative max-w-4xl mx-auto px-6 text-center z-10">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-violet-50 border border-violet-100 text-violet-600 text-xs font-bold uppercase tracking-wider mb-6 shadow-sm">
                <i data-lucide="sparkles" class="w-3.5 h-3.5 text-violet-500"></i>
                Now Active Across Major Hubs
                <i data-lucide="sparkles" class="w-3.5 h-3.5 text-violet-500"></i>
            </div>

            <h1 class="text-5xl md:text-7xl font-extrabold text-slate-900 tracking-tight leading-[1.1] mb-6">
                Drive Smarter. <br>
                <span class="bg-gradient-to-r from-slate-900 via-violet-800 to-indigo-600 bg-clip-text text-transparent">Manage Seamlessly.</span>
            </h1>

            <p class="text-lg md:text-xl text-gray-500 max-w-2xl mx-auto font-medium leading-relaxed mb-10">
                Experience the future of vehicle hire. Simple, reliable, exceptional and designed for you. 
            </p>

            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="{{ route('login') }}" class="w-full sm:w-auto flex items-center justify-center gap-3 px-8 py-4 bg-slate-50 text-slate-700 rounded-2xl border border-slate-100 font-bold text-base shadow-xl shadow-slate-200 hover:scale-[1.02] transition-all active:scale-95 group">
                    Get Started
                    <i data-lucide="arrow-right" class="w-5 h-5 group-hover:translate-x-1 transition-transform"></i>
                </a>
            </div>
        </div>

        <div class="absolute bottom-0 left-0 right-0 h-24 bg-gradient-to-t from-slate-50 to-transparent"></div>
    </main>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>