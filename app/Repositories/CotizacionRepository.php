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

    public function getAll()
    {
        return Cotizacion::all();
    }

    public function getById(int $id)
    {
        return Cotizacion::findOrFail($id);
    }

    public function create(array $data)
    {
        return Cotizacion::create($data);
    }

    public function update(array $data, int $id)
    {
        $cotizacion = $this->getById($id);
        $cotizacion->update($data);
        return $cotizacion;
    }

    public function delete(int $id)
    {
        $cotizacion = $this->getById($id);
        return $cotizacion->delete();
    }
}