<?php

namespace App\Http\Controllers;

use App\Services\RegistroConectividadService;
use App\Http\Requests\StoreRegistroConectividadRequest;
use App\Http\Requests\UpdateRegistroConectividadRequest;

class RegistroConectividadController extends Controller
{
    protected RegistroConectividadService $registroConectividadService;

    public function __construct(RegistroConectividadService $registroConectividadService)
    {
        $this->registroConectividadService = $registroConectividadService;
    }

    public function index()
    {
        return response()->json($this->registroConectividadService->all(), 200);
    }

    public function store(StoreRegistroConectividadRequest $request)
    {
        $registroConectividad = $this->registroConectividadService->store($request->validated());

        return response()->json([
            "message" => "El registro de conectividad se creó correctamente",
            "data" => $registroConectividad
        ], 201);
    }

    public function show(string $id_registro_conectividad)
    {
        $registroConectividad = $this->registroConectividadService->show($id_registro_conectividad);
        return response()->json($registroConectividad, 200);
    }

    public function update(UpdateRegistroConectividadRequest $request, $id_registro_conectividad)
    {
        $registroConectividad = $this->registroConectividadService->update($request->validated(), (int) $id_registro_conectividad);

        return response()->json([
            "message" => "El registro de conectividad se actualizó correctamente",
            "data" => $registroConectividad
        ], 200);
    }

    public function destroy($id_registro_conectividad)
    {
        $this->registroConectividadService->destroy((int) $id_registro_conectividad);

        return response()->json([
            "message" => "El registro de conectividad se eliminó correctamente"
        ], 200);
    }
}