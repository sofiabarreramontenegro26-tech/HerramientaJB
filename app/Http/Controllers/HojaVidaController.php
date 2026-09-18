<?php

namespace App\Http\Controllers;

use App\Services\HojaVidaService;
use App\Http\Requests\HojaVida\StoreHojaVidaRequest;
use App\Http\Requests\HojaVida\UpdateHojaVidaRequest;

class HojaVidaController extends Controller
{
    protected HojaVidaService $hojaVidaService;

    public function __construct(HojaVidaService $hojaVidaService)
    {
        $this->hojaVidaService = $hojaVidaService;
    }

    public function index()
    {
        return response()->json($this->hojaVidaService->obtenerTodas(), 200);
    }

    public function store(StoreHojaVidaRequest $request)
    {
        $hojaVida = $this->hojaVidaService->crear($request->validated());

        return response()->json([
            "message" => "La hoja de vida se creó correctamente",
            "data" => $hojaVida
        ], 201);
    }

    public function show(string $id_hoja_vida)
    {
        $hojaVida = $this->hojaVidaService->obtenerPorId($id_hoja_vida);
        return response()->json($hojaVida, 200);
    }

    public function update(UpdateHojaVidaRequest $request, $id_hoja_vida)
    {
        $hojaVida = $this->hojaVidaService->actualizar($id_hoja_vida, $request->validated());

        return response()->json([
            "message" => "La hoja de vida se actualizó correctamente",
            "data" => $hojaVida
        ], 200);
    }

    public function destroy($id_hoja_vida)
    {
        $this->hojaVidaService->eliminar($id_hoja_vida);

        return response()->json([
            "message" => "La hoja de vida se eliminó correctamente"
        ], 200);
    }
}