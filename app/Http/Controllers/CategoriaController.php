<?php

namespace App\Http\Controllers;

use App\Services\CategoriaService;
use App\Http\Requests\StoreCategoriaRequest;
use App\Http\Requests\UpdateCategoriaRequest;

class CategoriaController extends Controller
{
    protected CategoriaService $categoriaService;

    public function __construct(CategoriaService $categoriaService)
    {
        $this->categoriaService = $categoriaService;
    }

    public function index()
    {
        return response()->json($this->categoriaService->all(), 200);
    }

    public function store(StoreCategoriaRequest $request)
    {
        $categoria = $this->categoriaService->store($request->validated());

        return response()->json([
            'message' => 'Categoría creada correctamente',
            'data' => $categoria
        ], 201);
    }

    public function show($id_categoria)
    {
        $categoria = $this->categoriaService->show($id_categoria);

        return response()->json($categoria, 200);
    }

    public function update(UpdateCategoriaRequest $request, $id_categoria)
    {
        $categoria = $this->categoriaService->update(
        $request->validated(),(int) $id_categoria);

        return response()->json([
            'message' => 'Categoría actualizada correctamente',
            'data' => $categoria
        ], 200);
    }

    public function destroy($id_categoria)
    {
        $this->categoriaService->destroy((int)$id_categoria);

        return response()->json([
            'message' => 'Categoría eliminada correctamente'
        ], 200);
    }
}