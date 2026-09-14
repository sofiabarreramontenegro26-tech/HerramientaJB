<?php

namespace App\Http\Controllers;

use App\Services\ProductoService;
use App\Http\Requests\Producto\StoreProductoRequest;
use App\Http\Requests\Producto\UpdateProductoRequest;

class ProductoController extends Controller
{
    protected ProductoService $productoService;

    public function __construct(ProductoService $productoService)
    {
        $this->productoService = $productoService;
    }

    public function index()
    {
        return response()->json($this->productoService->obtenerTodos(), 200);
    }

    public function store(StoreProductoRequest $request)
    {
        $producto = $this->productoService->crear($request->validated());

        return response()->json([
            'message' => 'Producto creado correctamente',
            'data' => $producto
        ], 201);
    }

    public function show($id_producto)
    {
        $producto = $this->productoService->obtenerPorId($id_producto);

        return response()->json($producto, 200);
    }

    public function update(UpdateProductoRequest $request, $id_producto)
    {
        $producto = $this->productoService->actualizar($id_producto, $request->validated());

        return response()->json([
            'message' => 'Producto actualizado correctamente',
            'data' => $producto
        ], 200);
    }

    public function destroy($id_producto)
    {
        $this->productoService->eliminar($id_producto);

        return response()->json([
            'message' => 'Producto eliminado correctamente'
        ], 200);
    }
}