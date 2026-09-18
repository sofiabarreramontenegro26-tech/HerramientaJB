<?php

namespace App\Http\Controllers;

use App\Services\MantenimientoService;
use App\Http\Requests\Mantenimiento\StoreMantenimientoRequest;
use App\Http\Requests\Mantenimiento\UpdateMantenimientoRequest;

class MantenimientoController extends Controller
{
    protected MantenimientoService $mantenimientoService;

    public function __construct(MantenimientoService $mantenimientoService)
    {
        $this->mantenimientoService = $mantenimientoService;
    }

    public function index()
    {
        return response()->json($this->mantenimientoService->obtenerTodas(), 200);
    }

    public function store(StoreMantenimientoRequest $request)
    {
        $mantenimiento = $this->mantenimientoService->crear($request->validated());

        return response()->json([
            "message" => "El mantenimiento se registró correctamente",
            "data" => $mantenimiento
        ], 201);
    }

    public function show(string $id_mantenimiento)
    {
        $mantenimiento = $this->mantenimientoService->obtenerPorId($id_mantenimiento);
        return response()->json($mantenimiento, 200);
    }

    public function update(UpdateMantenimientoRequest $request, $id_mantenimiento)
    {
        $mantenimiento = $this->mantenimientoService->actualizar($id_mantenimiento, $request->validated());

        return response()->json([
            "message" => "El mantenimiento se actualizó correctamente",
            "data" => $mantenimiento
        ], 200);
    }

    public function destroy($id_mantenimiento)
    {
        $this->mantenimientoService->eliminar($id_mantenimiento);

        return response()->json([
            "message" => "El mantenimiento se eliminó correctamente"
        ], 200);
    }
}