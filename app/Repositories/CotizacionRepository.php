<?php

namespace App\Repositories;

use App\Interfaces\CotizacionInterface;
use App\Models\Cotizacion;

class CotizacionRepository extends BaseRepository implements CotizacionInterface
{
    public function __construct(Cotizacion $model)
    {
        parent::__construct($model);
    }
}