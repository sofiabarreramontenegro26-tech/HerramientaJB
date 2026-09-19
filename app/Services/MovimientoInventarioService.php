<?php

namespace App\Services;

use App\Interfaces\MovimientoInventarioInterface;

class MovimientoInventarioService
{
    public function __construct(
        private MovimientoInventarioInterface $movimientoInventarioRepository
    ) {}

    public function all()
    {
        return $this->movimientoInventarioRepository->getAll();
    }

    public function show(int $id)
    {
        return $this->movimientoInventarioRepository->getById($id);
    }

    public function store(array $data)
    {
        return $this->movimientoInventarioRepository->create($data);
    }

    public function update(int $id, array $data)
    {
        return $this->movimientoInventarioRepository->update($data, $id);
    }

    public function destroy(int $id_movimiento)
    {
        return $this->movimientoInventarioRepository->delete($id_movimiento);
    }
}