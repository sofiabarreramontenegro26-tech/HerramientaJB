<?php

namespace App\Http\Controllers;

use App\Services\CatalogoBusquedaService;
use App\Http\Requests\StoreCatalogoBusquedaRequest;
use App\Http\Requests\UpdateCatalogoBusquedaRequest;

class CatalogoBusquedaController extends Controller
{
    protected CatalogoBusquedaService $catalogoService;

    public function __construct(CatalogoBusquedaService $catalogoService)
    {
        $this->catalogoService = $catalogoService;
    }

    public function index()
    {
        return response()->json($this->catalogoService->list(), 200);
    }

    public function store(StoreCatalogoBusquedaRequest $request)
    {
        $catalogo = $this->catalogoService->store($request->validated());

        return response()->json([
            'message' => 'Producto agregado al catálogo correctamente',
            'data' => $catalogo
        ], 201);
    }

    public function show(int $id_catalogo)
    {
        $catalogo = $this->catalogoService->show($id_catalogo);

        return response()->json($catalogo, 200);
    }

    public function update(UpdateCatalogoBusquedaRequest $request, int $id_catalogo)
    {
        $catalogo = $this->catalogoService->update($id_catalogo, $request->validated());

        return response()->json([
            'message' => 'Registro de catálogo actualizado correctamente',
            'data' => $catalogo
        ], 200);
    }

    public function destroy(int $id_catalogo)
    {
        $this->catalogoService->destroy($id_catalogo);

        return response()->json([
            'message' => 'Registro eliminado del catálogo correctamente'
        ], 200);
    }

    public function obtenerDestacados()
    {
        $destacados = $this->catalogoService->obtenerDestacados();

        return response()->json($destacados, 200);
    }
}