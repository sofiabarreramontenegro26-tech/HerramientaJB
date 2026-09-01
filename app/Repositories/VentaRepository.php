<?php

namespace App\Repositories;

use App\Interfaces\VentaInterface;
use App\Models\Venta;

class VentaRepository extends BaseRepository implements VentaInterface
{
    public function __construct(Venta $model)
    {
        parent::__construct($model);
    }

    public function getByUsuarioId(int $idUsuario)
    {
        $ventas = $this->model->where('id_usuario', $idUsuario)->get();

        if ($ventas->isEmpty()) {
            return null;
        }

        return $ventas;
    }

    public function getByCliente(string $cliente)
    {
        $ventas = $this->model->where('cliente', 'like', "%{$cliente}%")->get();

        if ($ventas->isEmpty()) {
            return null;
        }

        return $ventas;
    }

    public function getByRangoFechas(string $fechaInicio, string $fechaFin)
    {
        $ventas = $this->model->whereBetween('fecha', [$fechaInicio, $fechaFin])->get();

        if ($ventas->isEmpty()) {
            return null;
        }

        return $ventas;
    }
}