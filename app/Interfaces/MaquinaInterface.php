<?php

namespace App\Interfaces;

interface MaquinaInterface extends BaseInterface
{
    public function getByProveedorId(int $idProveedor);
    public function getByReferencia(string $referencia);
}