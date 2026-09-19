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

    public function getAll()
    {
        return HojaVida::all();
    }

    public function getById(int $id)
    {
        return HojaVida::findOrFail($id);
    }

    public function create(array $data)
    {
        return HojaVida::create($data);
    }

    public function update(int $id, array $data)
    {
        $hojaVida = $this->getById($id);
        $hojaVida->update($data);
        return $hojaVida;
    }

    public function delete(int $id)
    {
        $hojaVida = $this->getById($id);
        return $hojaVida->delete();
    }
}