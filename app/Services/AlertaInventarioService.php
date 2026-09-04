<?php

namespace App\Services;

class EntradaService
{
    public function __construct(
        private AlertaInventarioInterface $alertaInventarioRepository
    ) {}

    public function all()
    {
        return $this->alertaInventarioRepository->getAll();
    }

    public function show(int $id)
    {
        return $this->alertaInventarioRepository->getById($id);
    }

    public function store(array $data)
    {
        return $this->alertaInventarioRepository->create($data);
    }

    public function update(int $id, array $data)
    {
        return $this->alertaInventarioRepository->update($id, $data);
    }

    public function destroy(int $id)
    {
        return $this->alertaInventarioRepository->delete($id);
    }
}
