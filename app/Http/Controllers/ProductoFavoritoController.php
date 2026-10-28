<?php

namespace App\Http\Controllers;

use App\Services\ProductoFavoritoService;
use App\Http\Requests\StoreProductoFavoritoRequest;
use App\Http\Requests\UpdateProductoFavoritoRequest;

class ProductoFavoritoController extends Controller
{
    protected ProductoFavoritoService $productoFavoritoService;

    public function __construct(ProductoFavoritoService $productoFavoritoService)
    {
        $this->productoFavoritoService = $productoFavoritoService;
    }

    public function index()
    {
        return response()->json($this->productoFavoritoService->all(), 200);
    }

    public function store(StoreProductoFavoritoRequest $request)
    {
        $productoFavorito = $this->productoFavoritoService->store($request->validated());

        return response()->json([
            "message" => "El producto se agregó a favoritos correctamente",
            "data" => $productoFavorito
        ], 201);
    }

    public function show(string $id_producto_favorito)
    {
        $productoFavorito = $this->productoFavoritoService->show($id_producto_favorito);
        return response()->json($productoFavorito, 200);
    }

    public function update(UpdateProductoFavoritoRequest $request, $id_producto_favorito)
    {
        $data = $request->validated();
        $productoFavorito = $this->productoFavoritoService->update((int) $id_producto_favorito, $data);

        return response()->json([
            "message" => "El producto favorito se actualizó correctamente",
            "data" => $productoFavorito
        ], 200);
    }

    public function destroy($id_producto_favorito)
    {
        $this->productoFavoritoService->destroy((int) $id_producto_favorito);

        return response()->json([
            "message" => "El producto se eliminó de favoritos correctamente"
        ], 200);
    }
}