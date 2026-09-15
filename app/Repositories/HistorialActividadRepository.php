<?php

namespace App\Repositories;

use App\Interfaces\HistorialActividadInterface;
use App\Models\HistorialActividad;

class HistorialActividadRepository extends BaseRepository implements HistorialActividadInterface
{
    public function __construct(HistorialActividad $model)
    {
        parent::__construct($model);
    }
}