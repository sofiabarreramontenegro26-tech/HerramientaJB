<?php

namespace App\Services;

use App\Interfaces\CotizacionInterface;

class CotizacionService
{
    public function __construct(
        private CotizacionInterface $cotizacionRepository
    ) {}

    public function all()
    {
        return $this->cotizacionRepository->getAll();
    }

    public function show(int $id)
    {
        return $this->cotizacionRepository->getById($id);
    }

    public function store(array $data)
    {
        return $this->cotizacionRepository->create($data);
    }

    public function update(int $id, array $data)
    {
        return $this->cotizacionRepository->update($id, $data);
    }

    public function destroy(int $id)
    {
        return $this->cotizacionRepository->delete($id);
    }

    public function findByClienteTelefono(string $telefono)
    {
        return $this->cotizacionRepository->getByClienteTelefono($telefono);
    }
}