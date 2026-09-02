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
}