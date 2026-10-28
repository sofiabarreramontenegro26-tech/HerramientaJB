<?php

namespace App\Http\Controllers;

use App\Services\ProductoService;
use App\Http\Requests\StoreProductoRequest;
use App\Http\Requests\UpdateProductoRequest;

class ProductoController extends Controller
{
    protected ProductoService $productoService;

    public function __construct(ProductoService $productoService)
    {
        $this->productoService = $productoService;
    }

    public function index()
    {
        return response()->json($this->productoService->all(), 200);
    }

    public function store(StoreProductoRequest $request)
    {
        $producto = $this->productoService->store($request->validated());

        return response()->json([
            'message' => 'Producto creado correctamente',
            'data' => $producto
        ], 201);
    }

    public function show($id_producto)
    {
        $producto = $this->productoService->show($id_producto);

        return response()->json($producto, 200);
    }

    public function update(UpdateProductoRequest $request, $id_producto)
    {
        $data = $request->validated();
        $producto = $this->productoService->update((int) $id_producto, $data);

        return response()->json([
            'message' => 'Producto actualizado correctamente',
            'data' => $producto
        ], 200);
    }

    public function destroy($id_producto)
    {
        $this->productoService->destroy((int)$id_producto);

        return response()->json([
            'message' => 'Producto eliminado correctamente'
        ], 200);
    }
}