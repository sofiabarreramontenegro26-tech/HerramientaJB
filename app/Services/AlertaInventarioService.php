<?php

namespace App\Services;

use App\Interfaces\AlertaInventarioInterface;

class AlertaInventarioService
{
    public function __construct(
        private AlertaInventarioInterface $alertaInventarioRepository
    ){}

    public function list()
    {
        return $this->alertaInventarioRepository->all();
    }

    public function show(int $id)
    {
        return $this->alertaInventarioRepository->find($id);
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

    public function getByProducto(int $idProducto)
    {
        return $this->alertaInventarioRepository->getByProducto($idProducto);
    }

    public function getByEstadoLeido(bool $leido)
    {
        return $this->alertaInventarioRepository->getByEstadoLeido($leido);
    }

    public function getNoLeidas()
    {
        return $this->alertaInventarioRepository->getNoLeidas();
    }

    public function marcarComoLeida(int $idAlerta)
    {
        return $this->alertaInventarioRepository->marcarComoLeida($idAlerta);
    }
}