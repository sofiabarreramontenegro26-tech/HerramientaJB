<?php

namespace App\Repositories;

use App\Interfaces\VentaInterface;
use App\Models\Venta;

class VentaRepository extends BaseRepository implements VentaInterface
{
    public function __construct(Venta $model)
    {
        parent::__construct($model);
    }
}