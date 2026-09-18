<?php

namespace App\Http\Controllers;

use App\Services\CotizacionService;
use App\Http\Requests\Cotizacion\StoreCotizacionRequest;
use App\Http\Requests\Cotizacion\UpdateCotizacionRequest;

class CotizacionController extends Controller
{
    protected CotizacionService $cotizacionService;

    public function __construct(CotizacionService $cotizacionService)
    {
        $this->cotizacionService = $cotizacionService;
    }

    public function index()
    {
        return response()->json($this->cotizacionService->obtenerTodas(), 200);
    }

    public function store(StoreCotizacionRequest $request)
    {
        $cotizacion = $this->cotizacionService->crear($request->validated());

        return response()->json([
            "message" => "La cotización se creó correctamente",
            "data" => $cotizacion
        ], 201);
    }

    public function show(string $id_cotizacion)
    {
        $cotizacion = $this->cotizacionService->obtenerPorId($id_cotizacion);
        return response()->json($cotizacion, 200);
    }

    public function update(UpdateCotizacionRequest $request, $id_cotizacion)
    {
        $cotizacion = $this->cotizacionService->actualizar($id_cotizacion, $request->validated());

        return response()->json([
            "message" => "La cotización se actualizó correctamente",
            "data" => $cotizacion
        ], 200);
    }

    public function destroy($id_cotizacion)
    {
        $this->cotizacionService->eliminar($id_cotizacion);

        return response()->json([
            "message" => "La cotización se eliminó correctamente"
        ], 200);
    }
}