<?php

namespace App\Http\Controllers;

use App\Services\HistorialActividadService;
use App\Http\Requests\StoreHistorialActividadRequest;
use App\Http\Requests\UpdateHistorialActividadRequest;

class HistorialActividadController extends Controller
{
    protected HistorialActividadService $historialActividadService;

    public function __construct(HistorialActividadService $historialActividadService)
    {
        $this->historialActividadService = $historialActividadService;
    }

    public function index()
    {
        return response()->json($this->historialActividadService->all(), 200);
    }

    public function store(StoreHistorialActividadRequest $request)
    {
        $actividad = $this->historialActividadService->store($request->validated());

        return response()->json([
            'message' => 'Actividad registrada correctamente',
            'data' => $actividad
        ], 201);
    }

    public function show($id_historial)
    {
        $actividad = $this->historialActividadService->show($id_historial);

        return response()->json($actividad, 200);
    }

    public function update(UpdateHistorialActividadRequest $request, $id_historial)
{
        $data = $request->validated();
        $historialActividad = $this->historialActividadService->update((int) $id_historial, $data);

    return response()->json([
        'message' => 'Historial actualizado correctamente',
        'data' => $actividad
    ], 200);
}

    public function destroy($id_historial)
    {
        $this->historialActividadService->destroy((int)$id_historial);

        return response()->json([
            'message' => 'Registro de historial eliminado correctamente'
        ], 200);
    }
}