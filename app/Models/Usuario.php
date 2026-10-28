<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Usuario extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = "usuarios";

    protected $primaryKey = "id_usuario";

    protected $fillable = [
        "nombre_completo",
        "correo",
        "contraseña",
        "id_rol" // <-- Llave foránea incluida
    ];

    public function rol()
    {
        return $this->belongsTo(Rol::class, 'id_rol', 'id_rol');
    }

    public function historialActividades()
    {
        return $this->hasMany(HistorialActividad::class, 'id_usuario', 'id_usuario');
    }
}