<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerificarRol
{
    /**
     * Uso en rutas: ->middleware(VerificarRol::class . ':administrador')
     * o varios roles: ->middleware(VerificarRol::class . ':administrador,tecnico')
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $usuario = $request->user();

        if ($usuario === null || ! $usuario->tieneRol(...$roles)) {
            abort(403, 'Tu rol no tiene permiso para entrar a esta sección.');
        }

        return $next($request);
    }
}
