<?php

namespace App\Http\Controllers;

use App\Services\RegistroConectividadService;
use App\Http\Requests\StoreRegistroConectividadRequest;
use App\Http\Requests\UpdateRegistroConectividadRequest;

class RegistroConectividadController extends Controller
{
    public function __construct(private RegistroConectividadService $registroConectividadServicio)
    {
    }

    public function index()
    {
        return response()->json([
            "success" => "Se listaron correctamente",
            "data" => $this->registroConectividadServicio->all()
        ]);
    }

    public function store(StoreRegistroConectividadRequest $datos)
    {
        $registroInsertado = $this->registroConectividadServicio->store(
            $datos->validated()
        );

        return response()->json([
            "success" => "El registro de conectividad se creó correctamente",
            "datosInsertado" => $registroInsertado
        ]);
    }

    public function show(string $id)
    {
        return response()->json([
            "data" => $this->registroConectividadServicio->show((int) $id)
        ]);
    }

    public function update(UpdateRegistroConectividadRequest $datoActualizar, string $id)
    {
        $registroConectividad = $this->registroConectividadServicio->update(
            (int) $id,
            $datoActualizar->validated()
        );

        return response()->json([
            "success" => "El registro de conectividad se actualizó correctamente",
            "data" => $registroConectividad
        ]);
    }

    public function destroy(string $id)
    {
        $registroConectividad = $this->registroConectividadServicio->destroy((int) $id);

        return response()->json([
            "success" => "El registro de conectividad se eliminó correctamente",
            "data" => $registroConectividad
        ]);
    }
}