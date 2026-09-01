<?php

namespace App\Interfaces;

interface UsuarioInterface extends BaseInterface
{
    public function getById(int $idusuario);
    public function getByCorreo(string $correo);
    public function getByRolId(int $idrol);
}