<?php

namespace App\Http\Controllers;

use App\Services\MovimientoInventarioService;
use App\Http\Requests\StoreMovimientoInventarioRequest;
use App\Http\Requests\UpdateMovimientoInventarioRequest;

class MovimientoInventarioController extends Controller
{
    protected MovimientoInventarioService $movimientoInventarioService;

    public function __construct(MovimientoInventarioService $movimientoInventarioService)
    {
        $this->movimientoInventarioService = $movimientoInventarioService;
    }

    public function index()
    {
        return response()->json($this->movimientoInventarioService->all(), 200);
    }

    public function store(StoreMovimientoInventarioRequest $request)
    {
        $movimientoInventario = $this->movimientoInventarioService->store($request->validated());

        return response()->json([
            'message' => 'Movimiento de inventario registrado correctamente',
            'data' => $movimientoInventario
        ], 201);
    }

    public function show($id_movimiento)
    {
        $movimientoInventario = $this->movimientoInventarioService->show((int) $id_movimiento);

        return response()->json($movimientoInventario, 200);
    }

    public function update(UpdateMovimientoInventarioRequest $request, $id_movimiento)
    {

        $data = $request->validated();

        $movimientoInventario = $this->movimientoInventarioService->update($data, (int) $id_movimiento);

        return response()->json([
            'message' => 'Movimiento de inventario actualizado correctamente',
            'data' => $movimientoInventario
        ], 200);
    }

    public function destroy($id_movimiento)
    {
        $this->movimientoInventarioService->destroy((int) $id_movimiento);

        return response()->json([
            'message' => 'Movimiento de inventario eliminado correctamente'
        ], 200);
    }
}