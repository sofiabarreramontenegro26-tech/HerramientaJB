<?php

namespace App\Http\Controllers;

use App\Services\MantenimientoService;
use App\Http\Requests\StoreMantenimientoRequest;
use App\Http\Requests\UpdateMantenimientoRequest;

class MantenimientoController extends Controller
{
    protected MantenimientoService $mantenimientoService;

    public function __construct(MantenimientoService $mantenimientoService)
    {
        $this->mantenimientoService = $mantenimientoService;
    }

    public function index()
    {
        return response()->json($this->mantenimientoService->all(), 200);
    }

    public function store(StoreMantenimientoRequest $request)
    {
        $mantenimiento = $this->mantenimientoService->store($request->validated());

        return response()->json([
            "message" => "El mantenimiento se registró correctamente",
            "data" => $mantenimiento
        ], 201);
    }

    public function show(string $id_mantenimiento)
    {
        $mantenimiento = $this->mantenimientoService->show($id_mantenimiento);
        return response()->json($mantenimiento, 200);
    }

    public function update(UpdateMantenimientoRequest $request, $id_mantenimiento)
    {
        $mantenimiento = $this->mantenimientoService->update($request->validated(), (int) $id_mantenimiento);

        return response()->json([
            "message" => "El mantenimiento se actualizó correctamente",
            "data" => $mantenimiento
        ], 200);
    }

    public function destroy($id_mantenimiento)
    {
        $this->mantenimientoService->destroy((int) $id_mantenimiento);

        return response()->json([
            "message" => "El mantenimiento se eliminó correctamente"
        ], 200);
    }
}