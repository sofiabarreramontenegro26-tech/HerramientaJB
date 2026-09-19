<?php

namespace App\Http\Controllers;

use App\Services\RolService;
use App\Http\Requests\StoreRolRequest;
use App\Http\Requests\UpdateRolRequest;

class RolController extends Controller
{
    protected RolService $rolService;

    public function __construct(RolService $rolService)
    {
        $this->rolService = $rolService;
    }

    public function index()
    {
        return response()->json($this->rolService->all(), 200);
    }

    public function store(StoreRolRequest $request)
    {
        $rol = $this->rolService->store($request->validated());

        return response()->json([
            'message' => 'Rol creado correctamente.',
            'data' => $rol
        ], 201);
    }

    public function show($id_rol)
    {
        $rol = $this->rolService->show((int) $id_rol);

        return response()->json($rol, 200);
    }

    public function update(UpdateRolRequest $request, $id_rol)
    {
       
        $data = $request->validated();

        $rol = $this->rolService->update((int) $id_rol, $data);

        return response()->json([
            'message' => 'Rol actualizado correctamente.',
            'data' => $rol
        ], 200);
    }

    public function destroy($id_rol)
    {
        $this->rolService->destroy((int) $id_rol);

        return response()->json([
            'message' => 'Rol eliminado correctamente'
        ], 200);
    }
}