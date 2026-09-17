<?php

namespace App\Services;

use App\Interfaces\ProductoInterface;

class ProductoService
{
    public function __construct(
        private ProductoInterface $productoRepository
    ) {}

    public function all()
    {
        return $this->productoRepository->getAll();
    }

    public function show(int $id)
    {
        return $this->productoRepository->getById($id);
    }

    public function store(array $data)
    {
        return $this->productoRepository->create($data);
    }

    public function update(array $data, int $id)
    {
        return $this->productoRepository->update($data, $id);
    }

    public function destroy(int $id_producto)
    {
        return $this->productoRepository->delete($id_producto);
    }
}