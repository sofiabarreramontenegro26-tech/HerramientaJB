<?php

namespace App\Repositories;

use App\Interfaces\HistorialActividadInterface;
use App\Models\HistorialActividad;

class HistorialActividadRepository extends BaseRepository implements HistorialActividadInterface
{
    
    public function __construct(HistorialActividad $model)
    {
        parent::__construct($model);
    }

    public function getAll()
    {
        return HistorialActividad::all();
    }

    public function getById(int $id)
    {
        return HistorialActividad::findOrFail($id);
    }

    public function create(array $data)
    {
        return HistorialActividad::create($data);
    }

    public function update(int $id, array $data)
    {
        $historialActividad = $this->getById($id);
        $historialActividad->update($data);
        
        return $historialActividad;
    }

    public function delete(int $id)
    {
        $historialActividad = $this->getById($id);
        return $historialActividad->delete();
    }
}