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

    public function getByClienteTelefono(string $telefono)
    {
        $cotizaciones = $this->model->where('cliente_telefono', $telefono)->get();

        if ($cotizaciones->isEmpty()) {
            return null;
        }

        return $cotizaciones;
    }
}