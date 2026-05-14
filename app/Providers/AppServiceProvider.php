<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);

        // Share notifications with all views
        View::composer('*', function ($view) {

        /** @var \App\Models\User|null $user */
        $user = auth()->guard()->user();

        $notifications = $user 
            ? $user->notifications()
                ->latest()
                ->take(10)
                ->get()
            : collect();

        $view->with('notifications', $notifications);

    });
    }
}
