<?php

namespace App\Http\Controllers;

use App\Services\VentaService;
use App\Http\Requests\StoreVentaRequest;
use App\Http\Requests\UpdateVentaRequest;

class VentaController extends Controller
{
    public function __construct(private VentaService $ventaServicio)
    {
    }

    public function index()
    {
        return response()->json([
            "success" => "Se listaron correctamente",
            "data" => $this->ventaServicio->all()
        ]);
    }

    public function store(StoreVentaRequest $datos)
    {
        $registroInsertado = $this->ventaServicio->store(
            $datos->validated()
        );

        return response()->json([
            "success" => "La venta se creó correctamente",
            "datosInsertado" => $registroInsertado
        ]);
    }

    public function show(string $id)
    {
        return response()->json([
            "data" => $this->ventaServicio->show((int) $id)
        ]);
    }

    public function update(UpdateVentaRequest $datoActualizar, string $id)
    {
        $venta = $this->ventaServicio->update(
            (int) $id,
            $datoActualizar->validated()
        );

        return response()->json([
            "success" => "La venta se actualizó correctamente",
            "data" => $venta
        ]);
    }

    public function destroy(string $id)
    {
        $venta = $this->ventaServicio->destroy((int) $id);

        return response()->json([
            "success" => "La venta se eliminó correctamente",
            "data" => $venta
        ]);
    }
}