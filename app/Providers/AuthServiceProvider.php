<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Administrador;
use App\Models\Funcionario;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('delete-admin', function (User $user, Administrador $admin) {
            return $user->id === $admin->user_id;
        });

        Gate::define('delete-func', function (User $user, Funcionario $funcionario) {

            return $user->id === $funcionario->user_id || $user->isAdmin();

        });

        Gate::define('update-func', function (User $user, Funcionario $funcionario) {

            return $user->id === $funcionario->user_id || $user->isAdmin();

        });
    }
}