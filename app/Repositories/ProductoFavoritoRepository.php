<?php

namespace App\Repositories;

use App\Interfaces\ProductoFavoritoInterface;
use App\Models\ProductoFavorito;

class ProductoFavoritoRepository extends BaseRepository implements ProductoFavoritoInterface
{
    public function __construct(ProductoFavorito $model)
    {
        parent::__construct($model);
    }

    public function getByUsuarioId(int $idUsuario)
    {
        $favoritos = $this->model->where('id_usuario', $idUsuario)->get();

        if ($favoritos->isEmpty()) {
            return null;
        }

        return $favoritos;
    }

    public function getByProductoId(int $idProducto)
    {
        $favoritos = $this->model->where('id_producto', $idProducto)->get();

        if ($favoritos->isEmpty()) {
            return null;
        }

        return $favoritos;
    }
}