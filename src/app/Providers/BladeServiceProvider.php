<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot(): void
    {
        Blade::if('can_access_dashboard', fn () => Auth::check());

        Blade::if('profile', fn ($user) => Auth::check() && Auth::user()->id == $user->id);
    }
}
