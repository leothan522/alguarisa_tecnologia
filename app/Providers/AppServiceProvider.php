<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //Paginator::useBootstrapFive();
        Paginator::useBootstrapFour();
        //Asset URL para Livewire 3
        if (config('app.assetlivewire')){
            Livewire::setUpdateRoute(function ($handle) {
                return Route::post('/'.config('app.assetlivewire', 'laravel/public').'/livewire/update', $handle);
            });

            Livewire::setScriptRoute(function ($handle) {
                return Route::get(''.config('app.assetlivewire', 'laravel/public').'/livewire/livewire.js', $handle);
            });
        }
    }
}
