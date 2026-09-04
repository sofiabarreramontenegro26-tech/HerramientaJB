<?php

namespace App\Services;

use App\Interfaces\ConfiguracionAlertaInterface;

class ConfiguracionAlertaService
{
    public function __construct(
        private ConfiguracionAlertaInterface $configuracionAlertaRepository
    ){}

    public function list()
    {
        return $this->configuracionAlertaRepository->all();
    }

    public function show(int $id)
    {
        return $this->configuracionAlertaRepository->find($id);
    }

    public function store(array $data)
    {
        return $this->configuracionAlertaRepository->create($data);
    }

    public function update(int $id, array $data)
    {
        return $this->configuracionAlertaRepository->update($id, $data);
    }

    public function destroy(int $id)
    {
        return $this->configuracionAlertaRepository->delete($id);
    }

}
