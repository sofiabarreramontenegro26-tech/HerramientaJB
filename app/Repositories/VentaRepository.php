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

    public function getAll()
    {
        return Venta::all();
    }

    public function getById(int $id)
    {
        return Venta::findOrFail($id);
    }

    public function create(array $data)
    {
        return Venta::create($data);
    }

    public function update(int $id, array $data)
    {
        $venta = $this->getById($id);
        $venta->update($data);
        return $venta;
    }

    public function delete(int $id)
    {
        $venta = $this->getById($id);
        return $venta->delete();
    }
    
}