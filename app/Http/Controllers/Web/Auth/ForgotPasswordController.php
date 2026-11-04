<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use App\Models\Usuario;
use Illuminate\Support\Facades\DB;

class ForgotPasswordController extends Controller
{
    /**
     * Muestra la vista para solicitar el correo de recuperación.
     */
    public function create()
    {
        return view('auth.forgot-password');
    }

    /**
     * Procesa la solicitud y muestra el enlace de recuperación directamente en pantalla.
     */
    public function store(Request $request)
    {
        // 1. Validar que el correo exista en la tabla usuarios
        $request->validate([
            'correo' => ['required', 'email', 'exists:usuarios,correo'],
        ], [
            'correo.required' => 'El campo de correo electrónico es obligatorio.',
            'correo.email' => 'Debes ingresar un formato de correo válido.',
            'correo.exists' => 'Este correo no se encuentra registrado en el sistema del taller.',
        ]);

        // 2. Buscar al usuario
        $usuario = Usuario::where('correo', $request->correo)->first();

        // 3. Generar un token único de recuperación
        $token = Str::random(60);
        
        $resetUrl = url('reset-password/' . $token . '?correo=' . urlencode($usuario->correo));

        // 4. Registrar en el log por respaldo (opcional)
        Log::info("Enlace de recuperación para " . $usuario->correo . ": " . $resetUrl);

        // 5. Retornar a la vista pasando el estado y el enlace listo para hacer clic
        return back()->with([
            'status' => 'Se han generado las instrucciones de restablecimiento.',
            'resetUrl' => $resetUrl
        ]);
    }
}