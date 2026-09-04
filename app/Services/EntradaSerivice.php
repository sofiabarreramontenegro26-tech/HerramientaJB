<?php

namespace App\Services;

class EntradaService
{
    public function __construct(
        private EntradaInterface $entradaRepository
    ) {}

    public function all()
    {
        return $this->entradaRepository->getAll();
    }

    public function show(int $id)
    {
        return $this->Repository->getById($id);
    }

    public function store(array $data)
    {
        return $this->entradaRepository->create($data);
    }

    public function update(int $id, array $data)
    {
        return $this->entradaRepository->update($id, $data);
    }

    public function destroy(int $id)
    {
        return $this->entradaRepository->delete($id);
    }
}


