<?php

namespace App\Interfaces;

interface RolInterface extends BaseInterface
{
    public function getById(int $id_rol);
    public function getByNombre(string $nombre);
    public function getByDescripcion(string $descripcion);
}