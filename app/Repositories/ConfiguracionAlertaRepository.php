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

    public function getAll()
    {
        return ConfiguracionAlerta::all();
    }

    public function getById(int $id)
    {
        return ConfiguracionAlerta::findOrFail($id);
    }

    public function create(array $data)
    {
        return ConfiguracionAlerta::create($data);
    }

    public function update(array $data, int $id)
    {
        $configuracionAlerta = $this->getById($id);
        $configuracionAlerta->update($data);
        return $configuracionAlerta;
    }

    public function delete(int $id)
    {
        $configuracionAlerta = $this->getById($id);
        return $configuracionAlerta->delete();
    }
}
