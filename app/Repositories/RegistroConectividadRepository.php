<?php

namespace App\Repositories;

use App\Interfaces\RegistroConectividadInterface;
use App\Models\RegistroConectividad;

class RegistroConectividadRepository extends BaseRepository implements RegistroConectividadInterface
{
    public function __construct(RegistroConectividad $model)
    {
        parent::__construct($model);
    }

    public function getAll()
    {
        return RegistroConectividad::all();
    }

    public function getById(int $id)
    {
        return RegistroConectividad::findOrFail($id);
    }

    public function create(array $data)
    {
        return RegistroConectividad::create($data);
    }

    public function update(int $id, array $data)
    {
        $registroConectividad = $this->getById($id);
        $registroConectividad->update($data);
        return $registroConectividad;
    }

    public function delete(int $id)
    {
        $registroConectividad = $this->getById($id);
        return $registroConectividad->delete();
    }
}