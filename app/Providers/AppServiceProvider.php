<?php

namespace App\Providers;

use App\Contracts\Services\AdministradorContract;
use App\Services\Models\AdministradorService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(AdministradorContract::class, AdministradorService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}