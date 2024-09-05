<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
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
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {

        Gate::define('bienes', function ($user){
            return comprobarPermisos('bienes.index');
        });

        Gate::define('empresas', function ($user){
            return comprobarPermisos('empresas.index');
        });

        Gate::define('territorio', function ($user){
            return comprobarPermisos('territorio.index');
        });

        Gate::define('usuarios', function ($user){
            return comprobarPermisos('usuarios.index');
        });

        Gate::define('parametros', function ($user){
            return $user->role == 100;
        });

        Gate::define('pruebas', function ($user){
            return $user->role == 100;
        });

        Gate::define('fcm', function ($user) {
            return $user->role == 100;
        });

    }
}
