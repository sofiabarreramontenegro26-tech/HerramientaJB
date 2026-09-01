<?php

namespace App\Interfaces;

interface CotizacionInterface extends BaseInterface
{
    public function getByClienteTelefono(string $telefono);
}
