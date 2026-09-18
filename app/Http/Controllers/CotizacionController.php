<?php

namespace App\Http\Controllers;

use App\Services\CotizacionService;
use App\Http\Requests\StoreCotizacionRequest;
use App\Http\Requests\UpdateCotizacionRequest;

class CotizacionController extends Controller
{
    protected CotizacionService $cotizacionService;

    public function __construct(CotizacionService $cotizacionService)
    {
        $this->cotizacionService = $cotizacionService;
    }

    public function index()
    {
        return response()->json($this->cotizacionService->all(), 200);
    }

    public function store(StoreCotizacionRequest $request)
    {
        $cotizacion = $this->cotizacionService->store($request->validated());

        return response()->json([
            "message" => "La cotización se creó correctamente",
            "data" => $cotizacion
        ], 201);
    }

    public function show(string $id_cotizacion)
    {
        $cotizacion = $this->cotizacionService->show($id_cotizacion);
        return response()->json($cotizacion, 200);
    }

    public function update(UpdateCotizacionRequest $request, $id_cotizacion)
    {
        $cotizacion = $this->cotizacionService->update($request->validated(), (int) $id_cotizacion);

        return response()->json([
            "message" => "La cotización se actualizó correctamente",
            "data" => $cotizacion
        ], 200);
    }

    public function destroy($id_cotizacion)
    {
        $this->cotizacionService->destroy((int) $id_cotizacion);

        return response()->json([
            "message" => "La cotización se eliminó correctamente"
        ], 200);
    }
}