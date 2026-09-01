<?php

namespace App\Interfaces;

interface ProductoFavoritoInterface extends BaseInterface
{
    public function getByUsuarioId(int $idUsuario);
    public function getByProductoId(int $idProducto);
}