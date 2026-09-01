<?php

namespace App\Interfaces;

interface UsuarioInterface extends BaseInterface
{
    public function getById(int $id_usuario);
    public function getByCorreo(string $correo);
    public function getByRolId(int $id_rol);
}