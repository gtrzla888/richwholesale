<?php

namespace App\Providers;

use App\User;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies();

        $gate->define('isWholesaleAdmin', function ($user) {
           return $user->role = User::ROLE_WHOLESALE_ADMIN;
        });

        $gate->define('isWholesaleUser', function ($user) {
            return $user->role = User::ROLE_WHOLESALE_USER;
        });

        $gate->define('isCompanyUser', function ($user) {
            return $user->role = User::ROLE_COMPANY_USER;
        });

        $gate->define('isCompanyAdmin', function ($user) {
            return $user->role = User::ROLE_COMPANY_ADMIN;
        });
    }
}
