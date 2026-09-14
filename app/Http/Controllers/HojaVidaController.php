<?php

namespace App\Http\Controllers;

use App\Services\HojaVidaService;
use App\Http\Requests\StoreHojaVidaRequest;
use App\Http\Requests\UpdateHojaVidaRequest;

class HojaVidaController extends Controller
{
    public function __construct(private HojaVidaService $hojaVidaServicio)
    {
    }

    public function index()
    {
        return response()->json([
            "success" => "Se listaron correctamente",
            "data" => $this->hojaVidaServicio->all()
        ]);
    }

    public function store(StoreHojaVidaRequest $datos)
    {
        $registroInsertado = $this->hojaVidaServicio->store(
            $datos->validated()
        );

        return response()->json([
            "success" => "La hoja de vida se creó correctamente",
            "datosInsertado" => $registroInsertado
        ]);
    }

    public function show(string $id)
    {
        return response()->json([
            "data" => $this->hojaVidaServicio->show((int) $id)
        ]);
    }

    public function update(UpdateHojaVidaRequest $datoActualizar, string $id)
    {
        $hojaVida = $this->hojaVidaServicio->update(
            (int) $id,
            $datoActualizar->validated()
        );

        return response()->json([
            "success" => "La hoja de vida se actualizó correctamente",
            "data" => $hojaVida
        ]);
    }

    public function destroy(string $id)
    {
        $hojaVida = $this->hojaVidaServicio->destroy((int) $id);

        return response()->json([
            "success" => "La hoja de vida se eliminó correctamente",
            "data" => $hojaVida
        ]);
    }
}