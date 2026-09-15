<?php

namespace App\Services;

use App\Interfaces\UsuarioInterface;

class UsuarioService
{
    public function __construct(
        private UsuarioInterface $usuarioRepository
    ) {}

    public function all()
    {
        return $this->usuarioRepository->getAll();
    }

    public function show(int $id)
    {
        return $this->usuarioRepository->getById($id);
    }

    public function store(array $data)
    {
        return $this->usuarioRepository->create($data);
    }

    public function update(int $id, array $data)
    {
        return $this->usuarioRepository->update($id, $data);
    }

    public function destroy(int $id)
    {
        return $this->usuarioRepository->delete($id);
    }
}