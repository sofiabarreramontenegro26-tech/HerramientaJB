<?php

namespace App\Services;

use App\Interfaces\HojaVidaInterface;

class HojaVidaService
{
    public function __construct(
        private HojaVidaInterface $hojaVidaRepository
    ) {}

    public function all()
    {
        return $this->hojaVidaRepository->getAll();
    }

    public function show(int $id)
    {
        return $this->hojaVidaRepository->getById($id);
    }

    public function store(array $data)
    {
        return $this->hojaVidaRepository->create($data);
    }

    public function update(int $id, array $data)
    {
        return $this->hojaVidaRepository->update($id, $data);
    }

    public function destroy(int $id)
    {
        return $this->hojaVidaRepository->delete($id);
    }

    public function findByMaquinaId(int $idMaquina)
    {
        return $this->hojaVidaRepository->getByMaquinaId($idMaquina);
    }
}