<?php

namespace App\Repositories;

use App\Interfaces\UsuarioInterface;
use App\Models\Usuario; // O tu modelo correspondiente

class UsuarioRepository extends BaseRepository implements UsuarioInterface
{
     public function __construct(Usuario $model)
    {
        parent::__construct($model);
    }
    
    public function getAll()
    {
        return Usuario::all();
    }

    public function getById(int $id)
    {
        return Usuario::findOrFail($id);
    }

    public function create(array $data)
    {
        return Usuario::create($data);
    }

    public function update(int $id, array $data)
    {
        $usuario = $this->getById($id);
        $usuario->update($data);
        return $usuario;
    }

    public function delete(int $id)
    {
        $usuario = $this->getById($id);
        return $usuario->delete();
    }
}