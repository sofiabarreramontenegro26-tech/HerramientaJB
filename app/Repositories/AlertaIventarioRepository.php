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
}
