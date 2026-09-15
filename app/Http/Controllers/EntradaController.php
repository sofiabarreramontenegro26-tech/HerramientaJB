<?php

namespace App\Http\Controllers;

use App\Services\EntradaService;
use App\Http\Requests\Entrada\StoreEntradaRequest;
use App\Http\Requests\Entrada\UpdateEntradaRequest;

class EntradaController extends Controller
{
    protected EntradaService $entradaService;

    public function __construct(EntradaService $entradaService)
    {
        $this->entradaService = $entradaService;
    }

    public function index()
    {
        return response()->json($this->entradaService->obtenerTodas(), 200);
    }

    public function store(StoreEntradaRequest $request)
    {
        $entrada = $this->entradaService->crear($request->validated());

        return response()->json([
            'message' => 'Entrada creada correctamente',
            'data' => $entrada
        ], 201);
    }

    public function show($id_entrada)
    {
        $entrada = $this->entradaService->obtenerPorId($id_entrada);

        return response()->json($entrada, 200);
    }

    public function update(UpdateEntradaRequest $request, $id_entrada)
    {
        $entrada = $this->entradaService->actualizar($id_entrada, $request->validated());

        return response()->json([
            'message' => 'Entrada actualizada correctamente',
            'data' => $entrada
        ], 200);
    }

    public function destroy($id_entrada)
    {
        $this->entradaService->eliminar($id_entrada);

        return response()->json([
            'message' => 'Entrada eliminada correctamente'
        ], 200);
    }
}
