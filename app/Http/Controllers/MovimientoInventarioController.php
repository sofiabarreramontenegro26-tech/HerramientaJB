<?php

namespace App\Http\Controllers;

use App\Services\MovimientoInventarioService;
use App\Http\Requests\MovimientoInventario\StoreMovimientoInventarioRequest;
use App\Http\Requests\MovimientoInventario\UpdateMovimientoInventarioRequest;

class MovimientoInventarioController extends Controller
{
    protected MovimientoInventarioService $movimientoInventarioService;

    public function __construct(MovimientoInventarioService $movimientoInventarioService)
    {
        $this->movimientoInventarioService = $movimientoInventarioService;
    }

    public function index()
    {
        return response()->json($this->movimientoInventarioService->list(), 200);
    }

    public function store(StoreMovimientoInventarioRequest $request)
    {
        $movimientoInventario = $this->movimientoInventarioService->store($request->validated());

        return response()->json([
            'message' => 'Movimiento de inventario registrado correctamente',
            'data' => $movimientoInventario
        ], 201);
    }

    public function show(int $id)
    {
        $movimientoInventario = $this->movimientoInventarioService->show($id);

        return response()->json($movimientoInventario, 200);
    }

    public function update(UpdateMovimientoInventarioRequest $request, int $id)
    {
        $movimientoInventario = $this->movimientoInventarioService->update($id, $request->validated());

        return response()->json([
            'message' => 'Movimiento de inventario actualizado correctamente',
            'data' => $movimientoInventario
        ], 200);
    }

    public function destroy(int $id)
    {
        $this->movimientoInventarioService->destroy($id);

        return response()->json([
            'message' => 'Movimiento de inventario eliminado correctamente'
        ], 200);
    }
}