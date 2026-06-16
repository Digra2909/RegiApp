<?php

namespace App\Providers;

use App\Models\Direction;
use App\Models\Entite;
use App\Models\Equipement;
use App\Models\Poste;
use App\Models\User;
use App\Observers\ActivityObserver;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Spatie\Permission\Middlewares\PermissionMiddleware;
use Spatie\Permission\Middlewares\RoleMiddleware;
use Spatie\Permission\Middlewares\RoleOrPermissionMiddleware;

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
        // Alias Spatie permission middlewares if package is installed
        if (class_exists(RoleMiddleware::class)) {
            Route::aliasMiddleware('role', RoleMiddleware::class);
        }

        if (class_exists(PermissionMiddleware::class)) {
            Route::aliasMiddleware('permission', PermissionMiddleware::class);
        }

        if (class_exists(RoleOrPermissionMiddleware::class)) {
            Route::aliasMiddleware('role_or_permission', RoleOrPermissionMiddleware::class);
        }

        // Register model observers for automatic activity logging
        Entite::observe(ActivityObserver::class);
        Direction::observe(ActivityObserver::class);
        User::observe(ActivityObserver::class);
        Poste::observe(ActivityObserver::class);
        Equipement::observe(ActivityObserver::class);
    }
}
