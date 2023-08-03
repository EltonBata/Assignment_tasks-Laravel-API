<?php

namespace App\Providers;

use App\Contracts\Services\FuncionarioContract;
use App\Contracts\Services\UserContract;
use App\Services\Models\FuncionarioService;
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
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}