<?php

namespace App\Services;

use App\Interfaces\VentaInterface;

class VentaService
{
    public function __construct(
        private VentaInterface $ventaRepository
    ) {}

    public function all()
    {
        return $this->ventaRepository->getAll();
    }

    public function show(int $id)
    {
        return $this->ventaRepository->getById($id);
    }

    public function store(array $data)
    {
        return $this->ventaRepository->create($data);
    }

    public function update(int $id, array $data)
    {
        return $this->ventaRepository->update($id, $data);
    }

    public function destroy(int $id)
    {
        return $this->ventaRepository->delete($id);
    }

    public function findByUsuarioId(int $idUsuario)
    {
        return $this->ventaRepository->getByUsuarioId($idUsuario);
    }

    public function findByCliente(string $cliente)
    {
        return $this->ventaRepository->getByCliente($cliente);
    }

    public function findByRangoFechas(string $fechaInicio, string $fechaFin)
    {
        return $this->ventaRepository->getByRangoFechas($fechaInicio, $fechaFin);
    }
}