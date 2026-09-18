<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HojaVida extends Model
{
    use HasFactory; //HasFactory se va encargar de crear datos de prueba

    protected $table = "hoja_vidas";

    protected $primaryKey = "id_hoja_vida";

    protected $fillable = [
        "fecha_ingreso",
        "especificaciones_tecnicas",
        "id_maquina",
    ];

    protected $casts = [
        'fecha_ingreso' => 'date',
    ];

    public function maquina()
    {
        return $this->belongsTo(Maquina::class, 'id_maquina', 'id_maquina');
    }
}