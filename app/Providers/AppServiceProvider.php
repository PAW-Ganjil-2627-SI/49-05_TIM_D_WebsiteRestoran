<?php

namespace App\Providers;

use App\Models\Menu;
use App\Policies\MenuPolicy;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Mendaftarkan MenuPolicy
        Gate::policy(Menu::class, MenuPolicy::class);

        // Authorization Gate untuk Admin
        Gate::define('manage-menu', function ($user) {
            return $user->hasRole('admin');
        });
    }
}