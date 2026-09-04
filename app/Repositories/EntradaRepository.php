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
}
