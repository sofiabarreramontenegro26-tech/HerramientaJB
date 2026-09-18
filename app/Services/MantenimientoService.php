<?php

namespace App\Services;

use App\Interfaces\MantenimientoInterface;

class MantenimientoService
{
    public function __construct(
        private MantenimientoInterface $mantenimientoRepository
    ) {}

    public function all()
    {
        return $this->mantenimientoRepository->getAll();
    }

    public function show(int $id)
    {
        return $this->mantenimientoRepository->getById($id);
    }

    public function store(array $data)
    {
        return $this->mantenimientoRepository->create($data);
    }

    public function update(int $id, array $data)
    {
        return $this->mantenimientoRepository->update($id, $data);
    }

    public function destroy(int $id)
    {
        return $this->mantenimientoRepository->delete($id);
    }
}