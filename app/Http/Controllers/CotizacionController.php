<?php

namespace App\Http\Controllers;

use App\Services\CotizacionService;
use App\Http\Requests\StoreCotizacionRequest;
use App\Http\Requests\UpdateCotizacionRequest;

class CotizacionController extends Controller
{
    public function __construct(private CotizacionService $cotizacionServicio)
    {
    }

    public function index()
    {
        return response()->json([
            "success" => "Se listaron correctamente",
            "data" => $this->cotizacionServicio->all()
        ]);
    }

    public function store(StoreCotizacionRequest $datos)
    {
        $registroInsertado = $this->cotizacionServicio->store(
            $datos->validated()
        );

        return response()->json([
            "success" => "La cotización se creó correctamente",
            "datosInsertado" => $registroInsertado
        ]);
    }

    public function show(string $id)
    {
        return response()->json([
            "data" => $this->cotizacionServicio->show((int) $id)
        ]);
    }

    public function update(UpdateCotizacionRequest $datoActualizar, string $id)
    {
        $cotizacion = $this->cotizacionServicio->update(
            (int) $id,
            $datoActualizar->validated()
        );

        return response()->json([
            "success" => "La cotización se actualizó correctamente",
            "data" => $cotizacion
        ]);
    }

    public function destroy(string $id)
    {
        $cotizacion = $this->cotizacionServicio->destroy((int) $id);

        return response()->json([
            "success" => "La cotización se eliminó correctamente",
            "data" => $cotizacion
        ]);
    }
}