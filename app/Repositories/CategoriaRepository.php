<?php

namespace App\Repositories;

use App\Interfaces\CategoriaInterface;
use App\Models\Categoria;

class CategoriaRepository extends BaseRepository implements CategoriaInterface
{
  public function __construct(Categoria $model)
    {
        parent::__construct($model);
    }

    public function getAll()
    {
        return Categoria::all();
    }

    public function getById(int $id)
    {
        return Categoria::findOrFail($id);
    }

    public function create(array $data)
    {
        return Categoria    ::create($data);
    }

    public function update(int $id, array $data)
    {
        $categoria = $this->getById($id);
        $categoria->update($data);
        return $categoria;
    }

    public function delete(int $id)
    {
        $categoria = $this->getById($id);
        return $categoria->delete();
    }
}