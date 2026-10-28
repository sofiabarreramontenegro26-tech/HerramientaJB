<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\UsuarioRequest;
use App\Models\Rol;
use App\Models\Usuario;
use App\Services\RegistroActividad;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class UsuarioController extends Controller
{
    public function index(): View
    {
        return view('usuarios.index', [
            'usuarios' => Usuario::orderBy('nombre_completo')->paginate(15),
        ]);
    }

    public function create(): View
    {
        return view('usuarios.form', [
            'usuario' => new Usuario(),
            'roles' => Rol::orderBy('nombre')->get(),
        ]);
    }

    public function store(UsuarioRequest $request): RedirectResponse
    {
        $usuario = Usuario::create([
            'nombre_completo' => $request->validated('nombre_completo'),
            'correo' => $request->validated('correo'),
            'id_rol' => $request->validated('id_rol'),
            'contraseña' => Hash::make($request->validated('password')),
        ]);

        RegistroActividad::registrar("Creó el usuario \"{$usuario->correo}\"");

        return redirect()->route('usuarios.index')->with('exito', 'Usuario creado.');
    }

    public function edit(Usuario $usuario): View
    {
        return view('usuarios.form', [
            'usuario' => $usuario,
            'roles' => Rol::orderBy('nombre')->get(),
        ]);
    }

    public function update(UsuarioRequest $request, Usuario $usuario): RedirectResponse
    {
        $datos = [
            'nombre_completo' => $request->validated('nombre_completo'),
            'correo' => $request->validated('correo'),
            'id_rol' => $request->validated('id_rol'),
        ];

        if ($request->filled('password')) {
            $datos['contraseña'] = Hash::make($request->validated('password'));
        }

        $usuario->update($datos);

        RegistroActividad::registrar("Editó el usuario \"{$usuario->correo}\"");

        return redirect()->route('usuarios.index')->with('exito', 'Usuario actualizado.');
    }

    public function destroy(Request $request, Usuario $usuario): RedirectResponse
    {
        if ($usuario->is($request->user())) {
            return back()->with('error', 'No puedes eliminar tu propio usuario.');
        }

        $usuario->delete();

        RegistroActividad::registrar("Eliminó el usuario \"{$usuario->correo}\"");

        return redirect()->route('usuarios.index')->with('exito', 'Usuario eliminado.');
    }
}
