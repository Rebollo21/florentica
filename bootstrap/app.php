<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
->withMiddleware(function (Middleware $middleware) {
    // Registramos el alias aquí
    $middleware->alias([
        'role' => \App\Http\Middleware\CheckRole::class,
    ]);
    // Redefinimos el comportamiento de los invitados (no logueados)
    $middleware->redirectGuestsTo(fn () => abort(405));
})
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
