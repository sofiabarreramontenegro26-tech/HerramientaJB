<?php

namespace App\Services;

use App\Interfaces\ProductoFavoritoInterface;

class ProductoFavoritoService
{
    public function __construct(
        private ProductoFavoritoInterface $productoFavoritoRepository
    ) {}

    public function all()
    {
        return $this->productoFavoritoRepository->getAll();
    }

    public function show(int $id)
    {
        return $this->productoFavoritoRepository->getById($id);
    }

    public function store(array $data)
    {
        return $this->productoFavoritoRepository->create($data);
    }

    public function update(int $id, array $data)
    {
        return $this->productoFavoritoRepository->update($id, $data);
    }

    public function destroy(int $id)
    {
        return $this->productoFavoritoRepository->delete($id);
    }

    public function findByUsuarioId(int $idUsuario)
    {
        return $this->productoFavoritoRepository->getByUsuarioId($idUsuario);
    }

    public function findByProductoId(int $idProducto)
    {
        return $this->productoFavoritoRepository->getByProductoId($idProducto);
    }
}