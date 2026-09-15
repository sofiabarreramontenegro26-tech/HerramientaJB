<?php

namespace App\Services;

use App\Interfaces\CatalogoBusquedaInterface;

class CatalogoBusquedaService
{
    public function __construct(
        private CatalogoBusquedaInterface $catalogoBusquedaRepository
    ) {}

    public function list()
    {
        return $this->catalogoBusquedaRepository->all();
    }

    public function show(int $id)
    {
        return $this->catalogoBusquedaRepository->find($id);
    }

    public function store(array $data)
    {
        return $this->catalogoBusquedaRepository->create($data);
    }

    public function update(int $id, array $data)
    {
        return $this->catalogoBusquedaRepository->update($id, $data);
    }

    public function destroy(int $id)
    {
        return $this->catalogoBusquedaRepository->delete($id);
    }

    public function obtenerDestacados()
    {
        // Asumiendo que el repositorio implementa una consulta filtrada
        return $this->catalogoBusquedaRepository->all();
    }
}