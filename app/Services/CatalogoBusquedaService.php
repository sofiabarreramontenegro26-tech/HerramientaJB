<?php

namespace App\Services;

use App\Interfaces\CatalogoBusquedaInterface;

class CatalogoBusquedaService
{
    public function __construct(
        private CatalogoBusquedaInterface $catalogoBusquedaRepository
    ) {}

    public function all()
    {
        return $this->catalogoBusquedaRepository->getAll();
    }

    public function show(int $id)
    {
        return $this->catalogoBusquedaRepository->getById($id);
    }

    public function store(array $data)
    {
        return $this->catalogoBusquedaRepository->create($data);
    }

    public function update(int $id, array $data)
    {
        return $this->catalogoBusquedaRepository->update($data, $id);
    }

    public function destroy(int $id_alerta)
    {
        return $this->catalogoBusquedaRepository->delete($id_alerta);
    }
}