<?php

namespace App\Repositories;

use App\Interfaces\ConfiguracionAlertaInterface;
use App\Models\ConfiguracionAlerta;

class ConfiguracionAlertaRepository extends BaseRepository implements ConfiguracionAlertaInterface
{
    public function __construct(ConfiguracionAlerta $model)
    {
        parent::__construct($model);
    }
}
