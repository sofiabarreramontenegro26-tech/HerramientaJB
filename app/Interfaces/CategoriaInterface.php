<?php

namespace App\Interfaces;

interface CategoriaInterface extends BaseInterface
{
    public function getByNombre(string $nombre);
}