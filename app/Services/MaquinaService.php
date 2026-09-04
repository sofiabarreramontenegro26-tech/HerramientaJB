<?php

namespace App\Services;

use App\Interfaces\MaquinaInterface;

class MaquinaService
{
    public function __construct(
        private MaquinaInterface $maquinaRepository
    ) {}

    public function all()
    {
        return $this->maquinaRepository->getAll();
    }

    public function show(int $id)
    {
        return $this->maquinaRepository->getById($id);
    }

    public function store(array $data)
    {
        return $this->maquinaRepository->create($data);
    }

    public function update(int $id, array $data)
    {
        return $this->maquinaRepository->update($id, $data);
    }

    public function destroy(int $id)
    {
        return $this->maquinaRepository->delete($id);
    }

    public function findByProveedorId(int $idProveedor)
    {
        return $this->maquinaRepository->getByProveedorId($idProveedor);
    }

    public function findByReferencia(string $referencia)
    {
        return $this->maquinaRepository->getByReferencia($referencia);
    }
}