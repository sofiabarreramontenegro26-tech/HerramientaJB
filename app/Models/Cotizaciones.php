<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cotizacion extends Model
{
    use HasFactory;

    // Nombre de la tabla en la base de datos
    protected $table = 'cotizaciones';

    // Llave primaria personalizada
    protected $primaryKey = 'id_cotizacion';

    // Campos permitidos para asignación masiva
    protected $fillable = [
        'cliente_telefono',
        'productos_seleccionados',
        'total',
    ];

    // Convierte el campo JSON a un array de PHP automáticamente
    protected $casts = [
        'productos_seleccionados' => 'array',
        'total' => 'decimal:2',
    ];
}