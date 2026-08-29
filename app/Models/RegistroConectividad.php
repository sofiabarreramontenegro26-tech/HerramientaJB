<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistroConectividad extends Model
{
    use HasFactory; //HasFactory se va encargar de crear datos de prueba

    protected $table = "registros_conectividad";

    protected $primaryKey = "id_conectividad";

    protected $fillable = [
        "estado_conexion",
        "fecha_registro",
    ];

    protected $casts = [
        'estado_conexion' => 'boolean',
        'fecha_registro' => 'datetime',
    ];
}