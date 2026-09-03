<?php

namespace App\Services;

use App\Interfaces\MovimientoInventarioInterface;
use DateTimeInterface;

class MovimientoInventarioService
{
    public function __construct(
        private MovimientoInventarioInterface $movimientoInventarioRepository
    ){}

    public function list()
    {
        return $this->movimientoInventarioRepository->all();
    }

    public function show(int $id)
    {
        return $this->movimientoInventarioRepository->find($id);
    }

    public function store(array $data)
    {
        return $this->movimientoInventarioRepository->create($data);
    }

    public function update(int $id, array $data)
    {
        return $this->movimientoInventarioRepository->update($id, $data);
    }

    public function destroy(int $id)
    {
        return $this->movimientoInventarioRepository->delete($id);
    }

    public function getByProducto(int $idProducto)
    {
        return $this->movimientoInventarioRepository->getByProducto($idProducto);
    }

    public function getByTipoMovimiento(string $tipo)
    {
        return $this->movimientoInventarioRepository->getByTipoMovimiento($tipo);
    }

    public function getByFecha(DateTimeInterface|string $fecha)
    {
        return $this->movimientoInventarioRepository->getByFecha($fecha);
    }

    public function getByRangoFechas(DateTimeInterface|string $fechaInicio, DateTimeInterface|string $fechaFin)
    {
        return $this->movimientoInventarioRepository->getByRangoFechas($fechaInicio, $fechaFin);
    }

    public function getByOrigen(string $origen)
    {
        return $this->movimientoInventarioRepository->getByOrigen($origen);
    }
}
