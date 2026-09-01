<?php

namespace App\Interfaces;

use DateTimeInterface;

interface MovimientoInventarioInterface extends BaseInterface
{
    public function getByProducto(int $idProducto);

    public function getByTipoMovimiento(string $tipo);

    public function getByFecha(DateTimeInterface|string $fecha);

    public function getByOrigen(string $origen);
}
