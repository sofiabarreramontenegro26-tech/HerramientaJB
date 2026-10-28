<?php

namespace App\Services;

use App\Interfaces\EntradaInterface;

class EntradaService
{
    public function __construct(
        private EntradaInterface $entradaRepository
    ){}

    public function all()
    {
        return $this->entradaRepository->getAll();
    }

    public function show(int $id)
    {
        return $this->entradaRepository->getById($id);
    }

    public function store(array $data)
    {
        return $this->entradaRepository->create($data);
    }

    public function update(int $id, array $data)
    {
        return $this->entradaRepository->update($id, $data);
    }

    public function destroy(int $id_entrada)
    {
        return $this->entradaRepository->delete($id_entrada);
    }
}
