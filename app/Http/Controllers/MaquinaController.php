<?php

namespace App\Http\Controllers;

use App\Services\MaquinaService;
use App\Http\Requests\StoreMaquinaRequest;
use App\Http\Requests\UpdateMaquinaRequest;

class MaquinaController extends Controller
{
    protected MaquinaService $maquinaService;

    public function __construct(MaquinaService $maquinaService)
    {
        $this->maquinaService = $maquinaService;
    }

    public function index()
    {
        return response()->json($this->maquinaService->all(), 200);
    }

    public function store(StoreMaquinaRequest $request)
    {
        $maquina = $this->maquinaService->store($request->validated());

        return response()->json([
            "message" => "La máquina se creó correctamente",
            "data" => $maquina
        ], 201);
    }

    public function show(string $id_maquina)
    {
        $maquina = $this->maquinaService->show($id_maquina);
        return response()->json($maquina, 200);
    }

    public function update(UpdateMaquinaRequest $request, $id_maquina)
    {
        $maquina = $this->maquinaService->update($request->validated(), (int) $id_maquina);

        return response()->json([
            "message" => "La máquina se actualizó correctamente",
            "data" => $maquina
        ], 200);
    }

    public function destroy($id_maquina)
    {
        $this->maquinaService->destroy((int) $id_maquina);

        return response()->json([
            "message" => "La máquina se eliminó correctamente"
        ], 200);
    }
}