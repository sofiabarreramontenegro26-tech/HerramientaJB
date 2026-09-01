<?php

namespace App\Interfaces;

interface UsuarioInterface extends BaseInterface
{
    public function getByCorreo(string $correo);
    public function getByRolId(int $rolId);
}