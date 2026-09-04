<?php

namespace App\Services;

use App\Interfaces\RegistroConectividadInterface;

class RegistroConectividadService
{
    public function __construct(
        private RegistroConectividadInterface $registroConectividadRepository
    ) {}

    public function all()
    {
        return $this->registroConectividadRepository->getAll();
    }

    public function show(int $id)
    {
        return $this->registroConectividadRepository->getById($id);
    }

    public function store(array $data)
    {
        return $this->registroConectividadRepository->create($data);
    }

    public function update(int $id, array $data)
    {
        return $this->registroConectividadRepository->update($id, $data);
    }

    public function destroy(int $id)
    {
        return $this->registroConectividadRepository->delete($id);
    }
}