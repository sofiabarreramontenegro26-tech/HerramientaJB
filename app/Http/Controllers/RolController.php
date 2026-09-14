<?php

namespace App\Http\Controllers;

use App\Services\RolService;
use App\Http\Requests\Rol\StoreRolRequest;
use App\Http\Requests\Rol\UpdateRolRequest;

class RolController extends Controller
{
    protected RolService $rolService;

    public function __construct(RolService $rolService)
    {
        $this->rolService = $rolService;
    }

    public function index()
    {
        return response()->json($this->rolService->obtenerTodos(), 200);
    }

    public function store(StoreRolRequest $request)
    {
        $rol = $this->rolService->crear($request->validated());

        return response()->json([
            'message' => 'Rol creado correctamente',
            'data' => $rol
        ], 201);
    }

    public function show($id_rol)
    {
        $rol = $this->rolService->obtenerPorId($id_rol);

        return response()->json($rol, 200);
    }

    public function update(UpdateRolRequest $request, $id_rol)
    {
        $rol = $this->rolService->actualizar($id_rol, $request->validated());

        return response()->json([
            'message' => 'Rol actualizado correctamente',
            'data' => $rol
        ], 200);
    }

    public function destroy($id_rol)
    {
        $this->rolService->eliminar($id_rol);

        return response()->json([
            'message' => 'Rol eliminado correctamente'
        ], 200);
    }
}