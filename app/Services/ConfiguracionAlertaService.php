<?php

namespace App\Services;

use App\Interfaces\ConfiguracionAlertaInterface;

class ConfiguracionAlertaService
{
    public function __construct(
        private ConfiguracionAlertaInterface $configuracionAlertaRepository
    ){}

    public function all()
    {
        return $this->configuracionAlertaRepository->getAll();
    }

    public function show(int $id)
    {
        return $this->configuracionAlertaRepository->getById($id);
    }

    public function store(array $data)
    {
        return $this->configuracionAlertaRepository->create($data);
    }

    public function update(int $id, array $data)
    {
        return $this->configuracionAlertaRepository->update($data, $id);
    }

    public function destroy(int $id_configuracion)
    {
        return $this->configuracionAlertaRepository->delete($id_configuracion);
    }

}