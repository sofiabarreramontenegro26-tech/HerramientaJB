<?php

namespace App\Exceptions;

use App\Models\Producto;
use RuntimeException;

class StockInsuficienteException extends RuntimeException
{
    public static function para(Producto $producto, int $solicitado): self
    {
        return new self(sprintf(
            'Stock insuficiente para "%s": hay %d unidad(es) y se solicitaron %d.',
            $producto->nombre,
            $producto->cantidad,
            $solicitado
        ));
    }
}
