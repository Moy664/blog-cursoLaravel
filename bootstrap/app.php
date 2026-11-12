<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        then: function(){ // añadir nuevas rutas o archivos de routes
            Route::middleware(['web', 'auth']) //El middleware web nos ayuda con el token csrf, ademas añadir aqui los middleware le da a todo el grupo esa proteccion
            ->prefix('admin') //de esta manera ya no tengo que especificar /admin en cada ruta
            ->name('admin.') // de esta manera ya no tengo que especificar admin. de cada nombre de ruta 
            ->group(base_path('routes/admin.php'));
        },
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->shouldRenderJsonWhen(
            fn (Request $request) => $request->is('api/*') || $request->expectsJson(),
        );
    })->create();
