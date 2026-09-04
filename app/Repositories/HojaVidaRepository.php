<?php

namespace App\Repositories;

use App\Interfaces\HojaVidaInterface;
use App\Models\HojaVida;

class HojaVidaRepository extends BaseRepository implements HojaVidaInterface
{
    public function __construct(HojaVida $model)
    {
        parent::__construct($model);
    }
}