<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Plan;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //  'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Passport::routes();

        Gate::define('add-plan', function ($user, Plan $plan) {
            return $user->hasPermission('add-plan');
        });

        // Gate::define('admin', function($user){
        //     return $user->hasRole('admin');
        // });
        // Gate::define('editor', function($user){
        //     return $user->hasRole('editor');
        // });
        // Gate::define('manager', function($user){
        //     return $user->hasRole('manager');
        // });
    }
}
