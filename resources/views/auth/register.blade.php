<x-guest-layout>
    <div class="flex items-center justify-center mb-5 mt-3">
        <span class="text-xl text-slate-900 font-bold ">Register</span>
    </div>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <div class="relative mt-1">
                <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                    <i data-lucide="user" class="w-5 h-5 text-slate-500"></i>
                </div>
                <x-text-input id="name" class="block mt-1 w-full bg-slate-50 pl-12 py-3" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="John Doe" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <div class="relative mt-1">
                <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                    <i data-lucide="mail" class="w-5 h-5 text-slate-500"></i>
                </div>
                <x-text-input id="email" class="block mt-1 w-full bg-slate-50 pl-12 py-3" type="email" name="email" :value="old('email')" placeholder="you@example.com" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <div class="relative mt-1">
                <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                    <i data-lucide="lock" class="w-5 h-5 text-slate-500"></i>
                </div>
                <x-text-input id="password" class="block mt-1 w-full bg-slate-50 pl-12 py-3" type="password" name="password" placeholder="••••••••" required autocomplete="new-password " />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <div class="relative mt-1">
                <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                    <i data-lucide="lock" class="w-5 h-5 text-slate-500"></i>
                </div>
                <x-text-input id="password_confirmation" class="block mt-1 w-full bg-slate-50 pl-12 py-3" type="password" name="password_confirmation" placeholder="••••••••" required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex items-center justify-center mt-8 w-full">
                <x-primary-button class="w-full justify-center py-3 text-center rounded-xl">
                    {{ __('Register') }}
                </x-primary-button>
            </div>

            <div class="mt-4 mb-4 flex items-center justify-center">
                <a class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 hover:underline dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>
            </div>
    </form>
</x-guest-layout>
