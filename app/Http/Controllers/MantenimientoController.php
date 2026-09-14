<?php

namespace App\Http\Controllers;

use App\Services\MantenimientoService;
use App\Http\Requests\StoreMantenimientoRequest;
use App\Http\Requests\UpdateMantenimientoRequest;

class MantenimientoController extends Controller
{
    public function __construct(private MantenimientoService $mantenimientoServicio)
    {
    }

    public function index()
    {
        return response()->json([
            "success" => "Se listaron correctamente",
            "data" => $this->mantenimientoServicio->all()
        ]);
    }

    public function store(StoreMantenimientoRequest $datos)
    {
        $registroInsertado = $this->mantenimientoServicio->store(
            $datos->validated()
        );

        return response()->json([
            "success" => "El mantenimiento se creó correctamente",
            "datosInsertado" => $registroInsertado
        ]);
    }

    public function show(string $id)
    {
        return response()->json([
            "data" => $this->mantenimientoServicio->show((int) $id)
        ]);
    }

    public function update(UpdateMantenimientoRequest $datoActualizar, string $id)
    {
        $mantenimiento = $this->mantenimientoServicio->update(
            (int) $id,
            $datoActualizar->validated()
        );

        return response()->json([
            "success" => "El mantenimiento se actualizó correctamente",
            "data" => $mantenimiento
        ]);
    }

    public function destroy(string $id)
    {
        $mantenimiento = $this->mantenimientoServicio->destroy((int) $id);

        return response()->json([
            "success" => "El mantenimiento se eliminó correctamente",
            "data" => $mantenimiento
        ]);
    }
}