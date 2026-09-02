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
}
