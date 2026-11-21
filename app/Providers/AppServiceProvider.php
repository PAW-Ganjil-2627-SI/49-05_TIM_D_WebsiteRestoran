<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        Gate::define('akses-admin', fn (User $user) => $user->hasRole('admin')
            ? Response::allow()
            : Response::deny('Hanya admin yang boleh membuka halaman ini.'));
    }
}