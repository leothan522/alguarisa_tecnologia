<?php

namespace App\Http\Middleware;

use App\Traits\ToastBootstrap;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Symfony\Component\HttpFoundation\Response;

class UserPermisos
{
    use ToastBootstrap;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (comprobarPermisos(Route::currentRouteName())){
            return $next($request);
        }else{
            $this->flashBootstrap('info', 'No tienes permisos suficientes.');
            return redirect()->route('dashboard');
        }
    }
}
