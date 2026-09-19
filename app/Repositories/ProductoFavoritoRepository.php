<?php

namespace App\Repositories;

use App\Interfaces\ProductoFavoritoInterface;
use App\Models\ProductoFavorito;

class ProductoFavoritoRepository extends BaseRepository implements ProductoFavoritoInterface
{
    public function __construct(ProductoFavorito $model)
    {
        parent::__construct($model);
    }

    public function getAll()
    {
        return ProductoFavorito::all();
    }

    public function getById(int $id)
    {
        return ProductoFavorito::findOrFail($id);
    }

    public function create(array $data)
    {
        return ProductoFavorito::create($data);
    }

    public function update(int $id, array $data)
    {
        $productoFavorito = $this->getById($id);
        $productoFavorito->update($data);
        return $productoFavorito;
    }

    public function delete(int $id)
    {
        $productoFavorito = $this->getById($id);
        return $productoFavorito->delete();
    }
}