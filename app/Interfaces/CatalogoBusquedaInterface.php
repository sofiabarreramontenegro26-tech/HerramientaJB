<?php

namespace App\Interfaces;

interface CatalogoBusquedaInterface extends BaseInterface
{
    public function getByProducto(int $idProducto);

    public function getDestacados();

    public function getByEstadoDestacado(bool $destacado);
}
