<?php

namespace App\Repositories;

use App\Interfaces\ProveedorInterface;
use App\Models\Proveedor;

class ProveedorRepository extends BaseRepository implements ProveedorInterface
{
   
    public function __construct(Proveedor $model)
    {
        parent::__construct($model);
    }

    public function getAll()
    {
        return Proveedor::all();
    }

    public function getById(int $id)
    {
        return Proveedor::findOrFail($id);
    }

    public function create(array $data)
    {
        return Proveedor::create($data);
    }

    public function update(int $id, array $data)
    {
        $proveedor = $this->getById($id);
        $proveedor->update($data);
        return $proveedor;
    }

    public function delete(int $id)
    {
        $proveedor = $this->getById($id);
        return $proveedor->delete();
    }
}