<?php

namespace App\Http\Controllers;

use App\Services\ProveedorService;
use App\Http\Requests\Proveedor\StoreProveedorRequest;
use App\Http\Requests\Proveedor\UpdateProveedorRequest;

class ProveedorController extends Controller
{
    protected ProveedorService $proveedorService;

    public function __construct(ProveedorService $proveedorService)
    {
        $this->proveedorService = $proveedorService;
    }

    public function index()
    {
        return response()->json($this->proveedorService->obtenerTodos(), 200);
    }

    public function store(StoreProveedorRequest $request)
    {
        $proveedor = $this->proveedorService->crear($request->validated());

        return response()->json([
            'message' => 'Proveedor creado correctamente',
            'data' => $proveedor
        ], 201);
    }

    public function show($id_proveedor)
    {
        $proveedor = $this->proveedorService->obtenerPorId($id_proveedor);

        return response()->json($proveedor, 200);
    }

    public function update(UpdateProveedorRequest $request, $id_proveedor)
    {
        $proveedor = $this->proveedorService->actualizar($id_proveedor, $request->validated());

        return response()->json([
            'message' => 'Proveedor actualizado correctamente',
            'data' => $proveedor
        ], 200);
    }

    public function destroy($id_proveedor)
    {
        $this->proveedorService->eliminar($id_proveedor);

        return response()->json([
            'message' => 'Proveedor eliminado correctamente'
        ], 200);
    }
}