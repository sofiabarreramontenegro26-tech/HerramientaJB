<?php

namespace App\Repositories;

use App\Interfaces\UsuarioInterface;
use App\Models\Usuario;

class UsuarioRepository extends BaseRepository implements UsuarioInterface
{
    public function __construct(Usuario $model)
    {
        parent::__construct($model);
    }
}