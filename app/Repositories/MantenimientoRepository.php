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

    public function getAll()
    {
        return Mantenimiento::all();
    }

    public function getById(int $id)
    {
        return Mantenimiento::findOrFail($id);
    }

    public function create(array $data)
    {
        return Mantenimiento::create($data);
    }

    public function update(int $id, array $data)
    {
        $mantenimiento = $this->getById($id);
        $mantenimiento->update($data);
        return $mantenimiento;
    }

    public function delete(int $id)
    {
        $mantenimiento = $this->getById($id);
        return $mantenimiento->delete();
    }

}