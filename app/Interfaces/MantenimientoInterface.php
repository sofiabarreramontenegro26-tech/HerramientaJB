<?php

namespace App\Interfaces;

interface MantenimientoInterface extends BaseInterface
{
    public function getByMaquinaId(int $idMaquina);
    public function getByTipo(string $tipo);
}