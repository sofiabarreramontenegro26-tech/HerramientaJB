<?php

namespace App\Repositories;

use App\Interfaces\EntradaInterface;
use App\Models\Entrada;

class EntradaRepository extends BaseRepository implements EntradaInterface
{
   public function __construct(Entrada $model)
    {
        parent::__construct($model);
    }

    public function getAll()
    {
        return Entrada::all();
    }

    public function getById(int $id)
    {
        return Entrada::findOrFail($id);
    }

    public function create(array $data)
    {
        return Entrada::create($data);
    }

    public function update(array $data, int $id)
    {
        $entrada = $this->getById($id);
        $entrada->update($data);
        return $entrada;
    }

    public function delete(int $id)
    {
        $entrada = $this->getById($id);
        return $entrada->delete();
    }
}
