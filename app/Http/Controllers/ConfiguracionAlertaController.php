<?php

namespace App\Http\Controllers;

use App\Services\EntradaService;
use App\Http\Requests\Entrada\StoreEntradaRequest;
use App\Http\Requests\Entrada\UpdateEntradaRequest;

class EntradaController extends Controller
{
    protected EntradaService $entradaService;

    public function __construct(EntradaService $entradaService)
    {
        $this->entradaService = $entradaService;
    }

    public function index()
    {
        return response()->json($this->entradaService->obtenerTodas(), 200);
    }

    public function store(StoreEntradaRequest $request)
    {
        $resultado = $this->entradaService->crear($request->validated());

        return response()->json([
            'message' => 'Entrada registrada correctamente en el inventario',
            'data' => $resultado['entrada'],
            'alertas' => $resultado['alertas'] ?? null
        ], 201);
    }

    public function show(int $id)
    {
        $entrada = $this->entradaService->obtenerPorId($id);

        return response()->json($entrada, 200);
    }

    public function update(UpdateEntradaRequest $request, int $id)
    {
        $resultado = $this->entradaService->actualizar($id, $request->validated());

        return response()->json([
            'message' => 'Entrada de inventario actualizada correctamente',
            'data' => $resultado['entrada'],
            'alertas' => $resultado['alertas'] ?? null
        ], 200);
    }

    public function destroy(int $id)
    {
        $this->entradaService->eliminar($id);

        return response()->json([
            'message' => 'Entrada de inventario eliminada correctamente'
        ], 200);
    }

    public function consultarAlertas()
    {
        $alertas = $this->entradaService->obtenerAlertasConfiguradas();

        return response()->json([
            'data' => $alertas
        ], 200);
    }
}