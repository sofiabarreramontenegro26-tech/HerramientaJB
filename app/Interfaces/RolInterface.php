<?php

namespace App\Interfaces;

interface RolInterface extends BaseInterface
{
    public function getByNombre(string $nombre);
}