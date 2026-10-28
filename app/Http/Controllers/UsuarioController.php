<?php

namespace App\Http\Controllers;

use App\Services\UsuarioService;
use App\Http\Requests\StoreUsuarioRequest;
use App\Http\Requests\UpdateUsuarioRequest;

class UsuarioController extends Controller
{
    protected UsuarioService $usuarioService;

    public function __construct(UsuarioService $usuarioService)
    {
        $this->usuarioService = $usuarioService;
    }

    public function index()
    {
        return response()->json($this->usuarioService->all(), 200);
    }

    public function store(StoreUsuarioRequest $request)
    {
        $usuario = $this->usuarioService->store($request->validated());

        return response()->json([
            'message' => 'Usuario creado correctamente',
            'data' => $usuario
        ], 201);
    }

    public function show($id_usuario)
    {
        $usuario = $this->usuarioService->show((int) $id_usuario);

        return response()->json($usuario, 200);
    }

    public function update(UpdateUsuarioRequest $request, $id_usuario)
    {
        $data = $request->validated();
        $usuario = $this->usuarioService->update((int) $id_usuario, $data);

        return response()->json([
            'message' => 'Usuario actualizado correctamente',
            'data' => $usuario
        ], 200);
    }

    public function destroy($id_usuario)
    {
        $this->usuarioService->destroy((int) $id_usuario);

        return response()->json([
            'message' => 'Usuario eliminado correctamente'
        ], 200);
    }
}