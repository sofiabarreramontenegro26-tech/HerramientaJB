<?php

namespace App\Interfaces;

interface HojaVidaInterface extends BaseInterface
{
    public function getByMaquinaId(int $idMaquina);
}