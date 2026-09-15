<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mantenimiento extends Model
{
    use HasFactory; //HasFactory se va encargar de crear datos de prueba

    protected $table = "mantenimientos";

    protected $primaryKey = "id_mantenimiento";

    protected $fillable = [
        "tipo_mantenimiento",
        "descripcion",
        "fecha",
        "tecnico_responsable",
        "id_maquina",
    ];

    protected $casts = [
        'fecha' => 'date',
    ];

    public function maquina()
    {
        return $this->belongsTo(Maquina::class, 'id_maquina', 'id_maquina');
    }
}
