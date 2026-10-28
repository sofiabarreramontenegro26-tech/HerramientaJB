<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RegistroConectividad extends Model
{
    use HasFactory,SoftDeletes;
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