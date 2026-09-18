<?php

namespace App\Repositories;

use App\Interfaces\CatalogoBusquedaInterface;
use App\Models\CatalogoBusqueda;

class CatalogoBusquedaRepository extends BaseRepository implements CatalogoBusquedaInterface
{
   public function __construct(CatalogoBusqueda $model)
    {
        parent::__construct($model);
    }

    public function getAll()
    {
        return CatalogoBusqueda::all();
    }

    public function getById(int $id)
    {
        return CatalogoBusqueda::findOrFail($id);
    }

    public function create(array $data)
    {
        return CatalogoBusqueda::create($data);
    }

    public function update(array $data, int $id)
    {
        $catalogoBusqueda = $this->getById($id);
        $catalogoBusqueda->update($data);
        return $catalogoBusqueda;
    }

    public function delete(int $id)
    {
        $catalogoBusqueda = $this->getById($id);
        return $catalogoBusqueda->delete();
    }
}
