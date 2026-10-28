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

    public function getAll()
    {
        return MovimientoInventario::all();
    }

    public function getById(int $id)
    {
        return MovimientoInventario::findOrFail($id);
    }

    public function create(array $data)
    {
        return MovimientoInventario::create($data);
    }

    public function update(int $id, array $data)
    {
        $movimiento = $this->getById($id);
        $movimiento->update($data);
        return $movimiento;
    }

    public function delete(int $id)
    {
        $movimiento = $this->getById($id);
        return $movimiento->delete();
    }
}
