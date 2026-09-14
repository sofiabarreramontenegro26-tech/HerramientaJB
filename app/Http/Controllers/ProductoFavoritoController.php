<?php

namespace App\Http\Controllers;

use App\Services\ProductoFavoritoService;
use App\Http\Requests\StoreProductoFavoritoRequest;
use App\Http\Requests\UpdateProductoFavoritoRequest;

class ProductoFavoritoController extends Controller
{
    public function __construct(private ProductoFavoritoService $productoFavoritoServicio)
    {
    }

    public function index()
    {
        return response()->json([
            "success" => "Se listaron correctamente",
            "data" => $this->productoFavoritoServicio->all()
        ]);
    }

    public function store(StoreProductoFavoritoRequest $datos)
    {
        $registroInsertado = $this->productoFavoritoServicio->store(
            $datos->validated()
        );

        return response()->json([
            "success" => "El producto favorito se creó correctamente",
            "datosInsertado" => $registroInsertado
        ]);
    }

    public function show(string $id)
    {
        return response()->json([
            "data" => $this->productoFavoritoServicio->show((int) $id)
        ]);
    }

    public function update(UpdateProductoFavoritoRequest $datoActualizar, string $id)
    {
        $productoFavorito = $this->productoFavoritoServicio->update(
            (int) $id,
            $datoActualizar->validated()
        );

        return response()->json([
            "success" => "El producto favorito se actualizó correctamente",
            "data" => $productoFavorito
        ]);
    }

    public function destroy(string $id)
    {
        $productoFavorito = $this->productoFavoritoServicio->destroy((int) $id);

        return response()->json([
            "success" => "El producto favorito se eliminó correctamente",
            "data" => $productoFavorito
        ]);
    }

    public function getByUsuarioId(string $idUsuario)
    {
        return response()->json([
            "data" => $this->productoFavoritoServicio->findByUsuarioId((int) $idUsuario)
        ]);
    }

    public function getByProductoId(string $idProducto)
    {
        return response()->json([
            "data" => $this->productoFavoritoServicio->findByProductoId((int) $idProducto)
        ]);
    }
}