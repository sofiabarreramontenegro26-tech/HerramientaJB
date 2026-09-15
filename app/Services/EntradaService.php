<?php

namespace App\Services;

use App\Interfaces\EntradaInterface;

class EntradaService
{
    public function __construct(
        private EntradaInterface $entradaRepository
    ){}

    public function list()
    {
        return $this->entradaRepository->all();
    }

    public function show(int $id)
    {
        return $this->entradaRepository->find($id);
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
