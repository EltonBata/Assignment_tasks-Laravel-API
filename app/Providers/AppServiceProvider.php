<?php

namespace App\Providers;

use App\Contracts\Services\AdministradorContract;
use App\Contracts\Services\FuncionarioContract;
use App\Services\Models\AdministradorService;
use App\Services\Models\FuncionarioService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(AdministradorContract::class, AdministradorService::class);
        $this->app->bind(FuncionarioContract::class, FuncionarioService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}