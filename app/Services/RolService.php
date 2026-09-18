<?php

namespace App\Services;

use App\Interfaces\RolInterface;

class RolService
{
    public function __construct(
        private RolInterface $rolRepository
    ) {}

    public function all()
    {
        return $this->rolRepository->getAll();
    }

    public function show(int $id)
    {
        return $this->rolRepository->getById($id);
    }

    public function store(array $data)
    {
        return $this->rolRepository->create($data);
    }

    public function update(array $data, int $id)
    {
        return $this->rolRepository->update($data, $id);
    }

    public function destroy(int $id_rol)
    {
        return $this->rolRepository->delete($id_rol);
    }
}