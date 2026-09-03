<?php

namespace App\Services;

use App\Interfaces\CategoriaInterface;

class CategoriaService
{
    public function __construct(
        private CategoriaInterface $categoriaRepository
    ) {}

    public function all()
    {
        return $this->categoriaRepository->getAll();
    }

    public function show(int $id)
    {
        return $this->categoriaRepository->getById($id);
    }

    public function store(array $data)
    {
        return $this->categoriaRepository->create($data);
    }

    public function update(int $id, array $data)
    {
        return $this->categoriaRepository->update($id, $data);
    }

    public function destroy(int $id)
    {
        return $this->categoriaRepository->delete($id);
    }
}