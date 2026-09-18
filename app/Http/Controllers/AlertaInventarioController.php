<?php

namespace App\Http\Controllers;

use App\Services\AlertaInventarioService;
use App\Http\Requests\StoreAlertaInventarioRequest;
use App\Http\Requests\UpdateAlertaInventarioRequest;

class AlertaInventarioController extends Controller
{
    protected AlertaInventarioService $alertaService;

    public function __construct(AlertaInventarioService $alertaService)
    {
        $this->alertaService = $alertaService;
    }

    public function index()
    {
        return response()->json($this->alertaService->list(), 200);
    }

    public function store(StoreAlertaInventarioRequest $request)
    {
        $alerta = $this->alertaService->store($request->validated());

        return response()->json([
            'message' => 'Alerta de inventario creada correctamente',
            'data' => $alerta
        ], 201);
    }

    public function show(int $id_alerta)
    {
        $alerta = $this->alertaService->show($id_alerta);

        return response()->json($alerta, 200);
    }

    public function update(UpdateAlertaInventarioRequest $request, int $id_alerta)
    {
        $alerta = $this->alertaService->update($id_alerta, $request->validated());

        return response()->json([
            'message' => 'Alerta de inventario actualizada correctamente',
            'data' => $alerta
        ], 200);
    }

    public function destroy(int $id_alerta)
    {
        $this->alertaService->destroy($id_alerta);

        return response()->json([
            'message' => 'Alerta de inventario eliminada correctamente'
        ], 200);
    }

    public function marcarComoLeida(int $id_alerta)
    {
        $alerta = $this->alertaService->marcarComoLeida($id_alerta);

        return response()->json([
            'message' => 'Alerta marcada como leída',
            'data' => $alerta
        ], 200);
    }
}