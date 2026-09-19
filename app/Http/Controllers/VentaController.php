<?php

namespace App\Http\Controllers;

use App\Services\VentaService;
use App\Http\Requests\StoreVentaRequest;
use App\Http\Requests\UpdateVentaRequest;

class VentaController extends Controller
{
    protected VentaService $ventaService;

    public function __construct(VentaService $ventaService)
    {
        $this->ventaService = $ventaService;
    }

    public function index()
    {
        return response()->json($this->ventaService->all(), 200);
    }

    public function store(StoreVentaRequest $request)
    {
        $venta = $this->ventaService->store($request->validated());

        return response()->json([
            "message" => "La venta se creó correctamente",
            "data" => $venta
        ], 201);
    }

    public function show(string $id_venta)
    {
        $venta = $this->ventaService->show($id_venta);
        return response()->json($venta, 200);
    }

    public function update(UpdateVentaRequest $request, $id_venta)
    {
        $venta = $this->ventaService->update($request->validated(), (int) $id_venta);

        return response()->json([
            "message" => "La venta se actualizó correctamente",
            "data" => $venta
        ], 200);
    }

    public function destroy($id_venta)
    {
        $this->ventaService->destroy((int)$id_venta);

        return response()->json([
            "message" => "La venta se eliminó correctamente"
        ], 200);
    }
}