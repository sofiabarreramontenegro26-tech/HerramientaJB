<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory; //HasFactory se va encargar de crear datos de prueba

    protected $table = "ventas";

    protected $primaryKey = "id_venta";

    protected $fillable = [
        "cliente",
        "fecha",
        "total_venta",
        "ganancia_total",
        "id_usuario",
    ];

    protected $casts = [
        'fecha' => 'date',
        'total_venta' => 'decimal:2',
        'ganancia_total' => 'decimal:2',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario', 'id_usuario');
    }
}