<?php

namespace App\Providers;

use App\Contracts\Services\FuncionarioContract;
use App\Contracts\Services\RoleContract;
use App\Contracts\Services\TarefaContract;
use App\Contracts\Services\UserContract;
use App\Services\Models\FuncionarioService;
use App\Services\Models\RoleService;
use App\Services\Models\TarefaService;
use App\Services\Models\UserService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(FuncionarioContract::class, FuncionarioService::class);
        $this->app->bind(UserContract::class, UserService::class);
        $this->app->bind(RoleContract::class, RoleService::class);
        $this->app->bind(TarefaContract::class, TarefaService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}