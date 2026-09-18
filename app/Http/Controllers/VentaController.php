<?php

namespace App\Http\Controllers;

use App\Services\VentaService;
use App\Http\Requests\Venta\StoreVentaRequest;
use App\Http\Requests\Venta\UpdateVentaRequest;

class VentaController extends Controller
{
    protected VentaService $ventaService;

    public function __construct(VentaService $ventaService)
    {
        $this->ventaService = $ventaService;
    }

    public function index()
    {
        return response()->json($this->ventaService->obtenerTodas(), 200);
    }

    public function store(StoreVentaRequest $request)
    {
        $venta = $this->ventaService->crear($request->validated());

        return response()->json([
            "message" => "La venta se creó correctamente",
            "data" => $venta
        ], 201);
    }

    public function show(string $id_venta)
    {
        $venta = $this->ventaService->obtenerPorId($id_venta);
        return response()->json($venta, 200);
    }

    public function update(UpdateVentaRequest $request, $id_venta)
    {
        $venta = $this->ventaService->actualizar($id_venta, $request->validated());

        return response()->json([
            "message" => "La venta se actualizó correctamente",
            "data" => $venta
        ], 200);
    }

    public function destroy($id_venta)
    {
        $this->ventaService->eliminar($id_venta);

        return response()->json([
            "message" => "La venta se eliminó correctamente"
        ], 200);
    }
}