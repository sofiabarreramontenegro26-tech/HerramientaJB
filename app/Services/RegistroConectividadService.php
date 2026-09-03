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
}