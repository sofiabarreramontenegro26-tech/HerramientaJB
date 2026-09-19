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
        return response()->json($this->alertaService->all(), 200);
    }

    public function store(StoreAlertaInventarioRequest $request)
    {
        $alerta = $this->alertaService->store($request->validated());

        return response()->json([
            'message' => 'Alerta de inventario creada correctamente',
            'data' => $alerta
        ], 201);
    }

    public function show($id_alerta)
    {
        $alerta = $this->alertaService->show((int)$id_alerta);

        return response()->json($alerta, 200);
    }

    public function update(UpdateAlertaInventarioRequest $request, $id_alerta)
    {
        $data = $request->validated();
    
        $alerta = $this->alertaInventarioService->update((int) $id_alerta, $data);

        return response()->json([
            'message' => 'Alerta de inventario actualizada correctamente',
            'data' => $alerta
        ], 200);
    }

    public function destroy($id_alerta)
    {
        $this->alertaService->destroy((int)$id_alerta);

        return response()->json([
            'message' => 'Alerta de inventario eliminada correctamente'
        ], 200);
    }
}