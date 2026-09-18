<?php

namespace App\Http\Controllers;

use App\Services\ConfiguracionAlertaService;
use App\Http\Requests\ConfiguracionAlerta\StoreConfiguracionAlertaRequest;
use App\Http\Requests\ConfiguracionAlerta\UpdateConfiguracionAlertaRequest;

class ConfiguracionAlertaController extends Controller
{
    protected ConfiguracionAlertaService $configuracionAlertaService;

    public function __construct(ConfiguracionAlertaService $configuracionAlertaService)
    {
        $this->configuracionAlertaService = $configuracionAlertaService;
    }

    public function index()
    {
        return response()->json($this->configuracionAlertaService->list(), 200);
    }

    public function store(StoreConfiguracionAlertaRequest $request)
    {
        $configuracion = $this->configuracionAlertaService->store($request->validated());

        return response()->json([
            'message' => 'Configuración de alerta registrada correctamente',
            'data' => $configuracion
        ], 201);
    }

    public function show(int $id)
    {
        $configuracionAlerta = $this->configuracionAlertaService->show($id);

        return response()->json($configuracionAlerta, 200);
    }

    public function update(UpdateConfiguracionAlertaRequest $request, int $id)
    {
        $configuracion = $this->configuracionAlertaService->update($id, $request->validated());

        return response()->json([
            'message' => 'Configuración de alerta actualizada correctamente',
            'data' => $configuracion
        ], 200);
    }

    public function destroy(int $id)
    {
        $this->configuracionAlertaService->destroy($id);

        return response()->json([
            'message' => 'Configuración de alerta eliminada correctamente'
        ], 200);
    }

    public function consultarAlertas()
    {
        $alertas = $this->configuracionAlertaService->consultarAlertas();

        return response()->json([
            'data' => $alertas
        ], 200);
    }
}