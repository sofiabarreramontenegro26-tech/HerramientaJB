<?php

namespace App\Repositories;

use App\Interfaces\MaquinaInterface;
use App\Models\Maquina;

class MaquinaRepository extends BaseRepository implements MaquinaInterface
{
    public function __construct(Maquina $model)
    {
        parent::__construct($model);
    }

    public function getAll()
    {
        return Maquina::all();
    }

    public function getById(int $id)
    {
        return Maquina::findOrFail($id);
    }

    public function create(array $data)
    {
        return Maquina::create($data);
    }

    public function update(int $id, array $data)
    {
        $maquina = $this->getById($id);
        $maquina->update($data);
        return $maquina;
    }

    public function delete(int $id)
    {
        $maquina = $this->getById($id);
        return $maquina->delete();
    }

}