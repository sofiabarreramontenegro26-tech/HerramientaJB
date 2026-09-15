<?php

namespace App\Http\Controllers;

use App\Services\MaquinaService;
use App\Http\Requests\StoreMaquinaRequest;
use App\Http\Requests\UpdateMaquinaRequest;

class MaquinaController extends Controller
{
    public function __construct(private MaquinaService $maquinaServicio)
    {
    }

    public function index()
    {
        return response()->json([
            "success" => "Se listaron correctamente",
            "data" => $this->maquinaServicio->all()
        ]);
    }

    public function store(StoreMaquinaRequest $datos)
    {
        $registroInsertado = $this->maquinaServicio->store(
            $datos->validated()
        );

        return response()->json([
            "success" => "La máquina se creó correctamente",
            "datosInsertado" => $registroInsertado
        ]);
    }

    public function show(string $id)
    {
        return response()->json([
            "data" => $this->maquinaServicio->show((int) $id)
        ]);
    }

    public function update(UpdateMaquinaRequest $datoActualizar, string $id)
    {
        $maquina = $this->maquinaServicio->update(
            (int) $id,
            $datoActualizar->validated()
        );

        return response()->json([
            "success" => "La máquina se actualizó correctamente",
            "data" => $maquina
        ]);
    }

    public function destroy(string $id)
    {
        $maquina = $this->maquinaServicio->destroy((int) $id);

        return response()->json([
            "success" => "La máquina se eliminó correctamente",
            "data" => $maquina
        ]);
    }
}