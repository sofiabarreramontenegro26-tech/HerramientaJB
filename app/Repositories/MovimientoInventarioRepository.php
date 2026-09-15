<?php

namespace App\Repositories;

use App\Interfaces\MovimientoInventarioInterface;
use App\Models\MovimientoInventario;

class MovimientoInventarioRepository extends BaseRepository implements MovimientoInventarioInterface
{
    public function __construct(MovimientoInventario $model)
    {
        parent::__construct($model);
    }
}
