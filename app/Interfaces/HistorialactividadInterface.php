<?php

namespace App\Interfaces;

interface HistorialActividadInterface extends BaseInterface
{
    public function getByUsuarioId(int $usuarioId);
}