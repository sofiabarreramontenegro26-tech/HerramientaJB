<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    /**
     * Muestra la vista para ingresar la nueva contraseña.
     */
    public function create(Request $request, $token)
    {
        return view('auth.reset-password', [
            'token' => $token,
            'correo' => $request->query('correo')
        ]);
    }

    /**
     * Procesa el cambio de contraseña en la base de datos.
     */
    public function store(Request $request)
    {
        // 1. Validar las contraseñas
        $request->validate([
            'correo' => ['required', 'email', 'exists:usuarios,correo'],
            'password' => ['required', 'min:6', 'confirmed'],
        ], [
            'correo.exists' => 'El correo no es válido.',
            'password.required' => 'La nueva contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 6 caracteres.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
        ]);

        // 2. Buscar al usuario y actualizar su contraseña personalizada
        $usuario = Usuario::where('correo', $request->correo)->first();
        
        $usuario->contraseña = Hash::make($request->password);
        $usuario->save();

        // 3. Redirigir al login con mensaje de éxito
        return redirect()->route('login')->with('status', '¡Contraseña restablecida con éxito! Ya puedes iniciar sesión.');
    }
}