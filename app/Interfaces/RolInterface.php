<?php

namespace App\Interfaces;

interface RolInterface extends BaseInterface
{
    public function getById(int $idrol);
    public function getByNombre(string $nombre);
    public function getByDescripcion(string $descripcion);
}