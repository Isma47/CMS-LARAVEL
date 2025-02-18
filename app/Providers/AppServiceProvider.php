<?php

namespace App\Providers;


use App\Models\User;
use App\Services\Auth\AuthService;
use Illuminate\Support\Facades\Gate;
use App\Interface\Auth\AuthInterface;
use Illuminate\Support\ServiceProvider;
use App\Services\App\Admin\UserServicie;
use App\Services\App\PublicationsService;
use App\Interface\App\Admin\UserInterface;
use App\Interface\App\PublicationsInterface;
use App\Services\App\Admin\CategoriesServicie;
use App\Services\App\Admin\PublicationsSevice;
use App\Interface\App\Admin\CategoriesInterface;

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


        //Servicio que se va encargar de la logica dle usuario
        $this->app->bind(UserInterface::class, UserServicie::class);



        
        //Servicio que se encarga d ela logica de las publicaicones
        $this->app->bind(PublicationsInterface::class, PublicationsSevice::class);


        //Servicioquemanejala ligica d ela scategorias
        $this->app->bind(CategoriesInterface::class, CategoriesServicie::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        //Veriidcamos si al usuairo les mostramos roles de administración cuadno este en sesión
        Gate::define('admin', function (User $user) {
            return $user->role === User::ROLE_ADMINISTRATOR;
        });
    }
}
