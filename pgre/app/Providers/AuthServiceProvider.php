<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('admin-permission', function () {
            return Auth::user()->isAdmin();
        });

        Gate::define('tech-permission', function () {
            return Auth::user()->isTechnician();
        });

        Gate::define('front-permission', function () {
            return Auth::user()->isFrontUser();
        });

        Gate::define('auth-permission', function () {
            return Auth::user()->isAutenticated();
        });
    }
}
