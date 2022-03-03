<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Policies\LoginPolicy;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use App\Policies\UserPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Models\User' => 'App\Policies\UsersPolicy',
        // User::class => UserPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */

    public function boot()
    {
        $this->registerPolicies();

        // Gate::define('create_user', function($user,$permissions) {
        //     return $permissions->contains(1);
        //  });

        //  Gate::define('update_user', function($user,$permissions) {
        //     return $permissions->contains(2);
        //  });

        //  Gate::define('read_user', function($user,$permissions) {
        //     return $permissions->contains(3);
        //  });

        //  Gate::define('delete_user', function($user,$permissions) {
        //     return $permissions->contains(4);
        //  });

        // parent::registerPolicies($gate);

        // Gate::before(function ($user,$ability){
        //     $permission = $this->getPermission();
        //     return $permission->contains($ability);
        //     });
        // $gate->before(function ($user, $ability) use ($gate) {
        //     return $ability;
        // });
        // ;
    }

}
