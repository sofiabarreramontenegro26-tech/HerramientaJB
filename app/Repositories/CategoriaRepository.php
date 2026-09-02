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
}