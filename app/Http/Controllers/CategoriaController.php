<?php

namespace App\Http\Controllers;

use App\Services\CategoriaService;
use App\Http\Requests\Categoria\StoreCategoriaRequest;
use App\Http\Requests\Categoria\UpdateCategoriaRequest;

class CategoriaController extends Controller
{
    protected CategoriaService $categoriaService;

    public function __construct(CategoriaService $categoriaService)
    {
        $this->categoriaService = $categoriaService;
    }

    public function index()
    {
        return response()->json($this->categoriaService->obtenerTodas(), 200);
    }

    public function store(StoreCategoriaRequest $request)
    {
        $categoria = $this->categoriaService->crear($request->validated());

        return response()->json([
            'message' => 'Categoría creada correctamente',
            'data' => $categoria
        ], 201);
    }

    public function show($id_categoria)
    {
        $categoria = $this->categoriaService->obtenerPorId($id_categoria);

        return response()->json($categoria, 200);
    }

    public function update(UpdateCategoriaRequest $request, $id_categoria)
    {
        $categoria = $this->categoriaService->actualizar($id_categoria, $request->validated());

        return response()->json([
            'message' => 'Categoría actualizada correctamente',
            'data' => $categoria
        ], 200);
    }

    public function destroy($id_categoria)
    {
        $this->categoriaService->eliminar($id_categoria);

        return response()->json([
            'message' => 'Categoría eliminada correctamente'
        ], 200);
    }
}