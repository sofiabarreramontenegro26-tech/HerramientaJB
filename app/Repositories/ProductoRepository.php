<?php

namespace App\Repositories;

use App\Interfaces\ProductoInterface;
use App\Models\Producto;

class ProductoRepository extends BaseRepository implements ProductoInterface
{
   public function __construct(Producto $model)
    {
        parent::__construct($model);
    }

    public function getAll()
    {
        return Producto::all();
    }

    public function getById(int $id)
    {
        return Producto::findOrFail($id);
    }

    public function create(array $data)
    {
        return Producto::create($data);
    }

    public function update(array $data, int $id)
    {
        $producto = $this->getById($id);
        $producto->update($data);
        return $producto;
    }

    public function delete(int $id)
    {
        $producto = $this->getById($id);
        return $producto->delete();
    }
}