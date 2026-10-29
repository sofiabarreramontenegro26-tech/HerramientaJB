<?php

namespace App\Services;

use App\Models\HistorialActividad;
use Illuminate\Support\Facades\Auth;

class RegistroActividad
{
    /**
     * Guarda una acción en historial_actividades a nombre del usuario en sesión.
     */
    public static function registrar(string $accion): void
    {
        $idUsuario = Auth::id();

        if ($idUsuario === null) {
            return;
        }

        HistorialActividad::create([
            'accion' => $accion,
            'id_usuario' => $idUsuario,
        ]);
    }
}
