<?php

namespace App\Interfaces;

use DateTimeInterface;

interface EntradaInterface extends BaseInterface
{
    public function getByFecha(DateTimeInterface|string $fecha);

    public function getByCantidadMinima(int $cantidad); //cantidad

    public function getByProducto(int $idProducto);

    public function getByProveedor(int $idProveedor);
}