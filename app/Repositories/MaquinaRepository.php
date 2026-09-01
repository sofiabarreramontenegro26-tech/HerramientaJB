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

    public function getByProveedorId(int $idProveedor)
    {
        $maquinas = $this->model->where('id_proveedor', $idProveedor)->get();

        if ($maquinas->isEmpty()) {
            return null;
        }

        return $maquinas;
    }

    public function getByReferencia(string $referencia)
    {
        $maquinas = $this->model->where('referencia', $referencia)->get();

        if ($maquinas->isEmpty()) {
            return null;
        }

        return $maquinas;
    }
}