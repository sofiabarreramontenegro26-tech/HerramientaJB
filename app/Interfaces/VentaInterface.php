<?php

namespace App\Interfaces;

interface VentaInterface extends BaseInterface
{
    public function getByUsuarioId(int $idUsuario);
    public function getByCliente(string $cliente);
    public function getByRangoFechas(string $fechaInicio, string $fechaFin);
}