<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Services\RegistroActividad;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LoginController extends Controller
{
    public function create(): View
    {
        return view('auth.login');
    }

    public function store(LoginRequest $request): RedirectResponse
    {
        $credenciales = [
            'correo' => $request->validated('correo'),
            'password' => $request->validated('password'),
        ];

        if (! Auth::attempt($credenciales)) {
            return back()
                ->withErrors(['correo' => 'El correo o la contraseña no son correctos.'])
                ->onlyInput('correo');
        }

        $request->session()->regenerate();

        if (Auth::user()->rol === null) {
            Auth::logout();

            return back()
                ->withErrors(['correo' => 'Tu usuario no tiene un rol asignado. Habla con el administrador.'])
                ->onlyInput('correo');
        }

        RegistroActividad::registrar('Inició sesión');

        return redirect()->intended(route('dashboard'));
    }

    public function destroy(Request $request): RedirectResponse
    {
        RegistroActividad::registrar('Cerró sesión');

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
