<?php

namespace App\Providers;

use App\Models\User;
use App\PermissionName;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

final class AppServiceProvider extends ServiceProvider
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
        $this->defineGates();
    }

    private function defineGates(): void
    {
        $permissionNames = PermissionName::cases();
        foreach ($permissionNames as $permissionName) {
            Gate::define($permissionName->value, function (User $user) use ($permissionName) {
                return $user->hasPermissionTo($permissionName->value);
            });
        }
    }
}
