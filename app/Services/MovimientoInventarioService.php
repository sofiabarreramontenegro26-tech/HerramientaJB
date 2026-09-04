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

}
