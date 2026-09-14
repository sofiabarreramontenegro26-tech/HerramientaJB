<?php

namespace App\Http\Controllers;

use App\Services\HistorialActividadService;
use App\Http\Requests\HistorialActividad\StoreHistorialActividadRequest;
use App\Http\Requests\HistorialActividad\UpdateHistorialActividadRequest;

class HistorialActividadController extends Controller
{
    protected HistorialActividadService $historialActividadService;

    public function __construct(HistorialActividadService $historialActividadService)
    {
        $this->historialActividadService = $historialActividadService;
    }

    public function index()
    {
        return response()->json($this->historialActividadService->obtenerTodos(), 200);
    }

    public function store(StoreHistorialActividadRequest $request)
    {
        $actividad = $this->historialActividadService->crear($request->validated());

        return response()->json([
            'message' => 'Actividad registrada correctamente',
            'data' => $actividad
        ], 201);
    }

    public function show($id_historial)
    {
        $actividad = $this->historialActividadService->obtenerPorId($id_historial);

        return response()->json($actividad, 200);
    }

    public function update(UpdateHistorialActividadRequest $request, $id_historial)
    {
        $actividad = $this->historialActividadService->actualizar($id_historial, $request->validated());

        return response()->json([
            'message' => 'Historial actualizado correctamente',
            'data' => $actividad
        ], 200);
    }

    public function destroy($id_historial)
    {
        $this->historialActividadService->eliminar($id_historial);

        return response()->json([
            'message' => 'Registro de historial eliminado correctamente'
        ], 200);
    }
}