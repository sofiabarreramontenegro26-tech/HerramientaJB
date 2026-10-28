<?php

namespace App\Repositories;

use App\Interfaces\AlertaInventarioInterface;
use App\Models\AlertaInventario;

class AlertaInventarioRepository extends BaseRepository implements AlertaInventarioInterface
{
 public function __construct(AlertaInventario $model)
    {
        parent::__construct($model);
    }

    public function getAll()
    {
        return AlertaInventario::all();
    }

    public function getById(int $id)
    {
        return AlertaInventario::findOrFail($id);
    }

    public function create(array $data)
    {
        return AlertaInventario::create($data);
    }

    public function update(int $id, array $data)
    {
        $alerta = $this->getById($id);
        $alerta->update($data);
        return $alerta;
    }

    public function delete(int $id)
    {
        $alerta = $this->getById($id);
        return $alerta->delete();
    }
}
