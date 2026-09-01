<?php

namespace App\Interfaces;

interface AlertaInventarioInterface extends BaseInterface
{
    public function getByProducto(int $idProducto);

    public function getByEstadoLeido(bool $leido);

    public function getNoLeidas();

    public function marcarComoLeida(int $idAlerta);
}
