<?php

namespace App\Repositories;

use App\Interfaces\MantenimientoInterface;
use App\Models\Mantenimiento;

class MantenimientoRepository extends BaseRepository implements MantenimientoInterface
{
    public function __construct(Mantenimiento $model)
    {
        parent::__construct($model);
    }
}