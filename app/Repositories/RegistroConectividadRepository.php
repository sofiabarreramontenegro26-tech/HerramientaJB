<?php

namespace App\Repositories;

use App\Interfaces\RegistroConectividadInterface;
use App\Models\RegistroConectividad;

class RegistroConectividadRepository extends BaseRepository implements RegistroConectividadInterface
{
    public function __construct(RegistroConectividad $model)
    {
        parent::__construct($model);
    }
}