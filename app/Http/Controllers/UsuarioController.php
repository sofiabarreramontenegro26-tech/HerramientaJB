<?php

namespace App\Http\Controllers;

use App\Services\UsuarioService;
use App\Http\Requests\Usuario\StoreUsuarioRequest;
use App\Http\Requests\Usuario\UpdateUsuarioRequest;

class UsuarioController extends Controller
{
    protected UsuarioService $usuarioService;

    public function __construct(UsuarioService $usuarioService)
    {
        $this->usuarioService = $usuarioService;
    }

    public function index()
    {
        return response()->json($this->usuarioService->obtenerTodos(), 200);
    }

    public function store(StoreUsuarioRequest $request)
    {
        $usuario = $this->usuarioService->crear($request->validated());

        return response()->json([
            'message' => 'Usuario creado correctamente',
            'data' => $usuario
        ], 201);
    }

    public function show($id_usuario)
    {
        $usuario = $this->usuarioService->obtenerPorId($id_usuario);

        return response()->json($usuario, 200);
    }

    public function update(UpdateUsuarioRequest $request, $id_usuario)
    {
        $usuario = $this->usuarioService->actualizar($id_usuario, $request->validated());

        return response()->json([
            'message' => 'Usuario actualizado correctamente',
            'data' => $usuario
        ], 200);
    }

    public function destroy($id_usuario)
    {
        $this->usuarioService->eliminar($id_usuario);

        return response()->json([
            'message' => 'Usuario eliminado correctamente'
        ], 200);
    }
}