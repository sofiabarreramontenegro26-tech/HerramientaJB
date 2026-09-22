<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class HistorialActividad extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = "historial_actividades";

    protected $primaryKey = "id_historial";

    protected $fillable = [
        "accion",
        "id_usuario" // <-- Llave foránea incluida
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario', 'id_usuario');
    }
}