<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cotizacion extends Model
{
    use SoftDeletes;

    protected $table = 'cotizaciones';
    protected $primaryKey = 'id_cotizacion';

    protected $fillable = ['cliente_telefono', 'productos_seleccionados', 'total'];

    /**
     * productos_seleccionados guarda un arreglo con este formato:
     * [{"id_producto":1,"nombre":"...","cantidad":2,"precio_unitario":1000,"subtotal":2000}]
     */
    protected $casts = [
        'productos_seleccionados' => 'array',
        'total' => 'decimal:2',
    ];
}
