<?php

namespace App\Repositories;

use App\Interfaces\RolInterface;
use App\Models\Rol;

class RolRepository extends BaseRepository implements RolInterface
{
    public function __construct(Rol $model)
    {
        parent::__construct($model);
    }

    public function getAll()
    {
        return Rol::all();
    }

    public function getById(int $id)
    {
        return Rol::findOrFail($id);
    }

    public function create(array $data)
    {
        return Rol::create($data);
    }

    public function update(int $id, array $data)
    {
        $rol = $this->getById($id);
        $rol->update($data);
        return $rol;
    }

    public function delete(int $id)
    {
        $rol = $this->getById($id);
        return $rol->delete();
    }
}