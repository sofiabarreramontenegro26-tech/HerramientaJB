<?php

namespace App\Services;

use App\Interfaces\HistorialActividadInterface;

class HistorialActividadService
{
    public function __construct(
        private HistorialActividadInterface $historialActividadRepository
    ) {}

    public function all()
    {
        return $this->historialActividadRepository->getAll();
    }

    public function show(int $id)
    {
        return $this->historialActividadRepository->getById($id);
    }

    public function store(array $data)
    {
        return $this->historialActividadRepository->create($data);
    }

    public function update(int $id, array $data)
    {
        return $this->historialActividadRepository->update($id, $data);
    }

    public function destroy(int $id)
    {
        return $this->historialActividadRepository->delete($id);
    }
}