<?php

namespace App\Interfaces;

interface RegistroConectividadInterface extends BaseInterface
{
    public function getByEstado(bool $estado);
    public function getUltimoRegistro();
}