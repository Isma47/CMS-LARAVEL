<?php

namespace App\Providers;


use App\Services\Auth\AuthService;
use App\Interface\Auth\AuthInterface;
use Illuminate\Support\ServiceProvider;
use App\Services\App\PublicationsService;
use App\Interface\App\PublicationsInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //Registramos el servicio de authenticación
        $this->app->bind(AuthInterface::class, AuthService::class);


        //Registramos el servicio  paa obtener la logica de las publiaciones
        $this->app->bind(PublicationsInterface::class, PublicationsService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
