<?php

namespace App\Http\Controllers;

use App\Services\ConfiguracionAlertaService;
use App\Http\Requests\StoreConfiguracionAlertaRequest;
use App\Http\Requests\UpdateConfiguracionAlertaRequest;

class ConfiguracionAlertaController extends Controller
{
    protected ConfiguracionAlertaService $configuracionAlertaService;

    public function __construct(ConfiguracionAlertaService $configuracionAlertaService)
    {
        $this->configuracionAlertaService = $configuracionAlertaService;
    }

    public function index()
    {
        return response()->json($this->configuracionAlertaService->all(), 200);
    }

    public function store(StoreConfiguracionAlertaRequest $request)
    {
        $configuracion = $this->configuracionAlertaService->store($request->validated());

        return response()->json([
            'message' => 'Configuración de alerta registrada correctamente',
            'data' => $configuracion
        ], 201);
    }

    public function show(int $id_configuracion)
    {
        $configuracionAlerta = $this->configuracionAlertaService->show((int) $id_configuracion);

        return response()->json($configuracionAlerta, 200);
    }

    public function update(UpdateConfiguracionAlertaRequest $request, $id_movimiento)
    {
        $data = $request->validated();

        $configuracion = $this->configuracionAlertaService->update((int) $id_movimiento, $data);

        return response()->json([
            'message' => 'Configuración de alerta actualizada correctamente',
            'data' => $configuracion
        ], 200);
    }

    public function destroy($id_movimiento)
    {
        $this->configuracionAlertaService->destroy((int)$id_movimiento);

        return response()->json([
            'message' => 'Configuración de alerta eliminada correctamente'
        ], 200);
    }

}