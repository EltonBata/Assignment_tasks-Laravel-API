<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Etapa;
use App\Models\Funcionario;
use App\Models\Tarefa;
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
        Gate::define('create-resource', fn(User $user) => $user->isAdmin());

        Gate::define('update-role', fn(User $user) => $user->isAdmin());

        Gate::define('delete-role', fn(User $user) => $user->isAdmin());

        Gate::define('delete-func', function (User $user, Funcionario $funcionario) {

            return $user->id === $funcionario->user_id || $user->isAdmin();

        });

        Gate::define('update-func', function (User $user, Funcionario $funcionario) {

            return $user->id === $funcionario->user_id || $user->isAdmin();

        });

        Gate::define('update_task', function (User $user, Tarefa $task) {

            return $user->id === $task->administrador_id || in_array($user->id, $task->funcionarios()->allRelatedIds()->toArray());

        });

        Gate::define('delete_task', function (User $user, Tarefa $task) {

            return $user->id === $task->administrador_id;

        });

        Gate::define('show_task', function (User $user, Tarefa $task) {

            return $user->isAdmin() || in_array($user->id, $task->funcionarios()->allRelatedIds()->toArray());

        });

        Gate::define('etapa', function (User $user, $tarefa) {
            return in_array($tarefa, $user->funcionario->tarefas()->allRelatedIds()->toArray());
        });

        Gate::define('supervisao', function (User $user, $tarefa) {
            return $user->isSupervisor($tarefa);
        });


    }
}