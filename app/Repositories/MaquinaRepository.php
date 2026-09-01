<?php

namespace App\Repositories;

use App\Interfaces\MaquinaInterface;
use App\Models\Maquina;

class MaquinaRepository extends BaseRepository implements MaquinaInterface
{
    public function __construct(Maquina $model)
    {
        parent::__construct($model);
    }

}