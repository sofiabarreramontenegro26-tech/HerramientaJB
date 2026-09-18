<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class MovimientoInventario extends Model
{
    use HasFactory; 

    protected $table = "movimiento_inventario";
    protected $primaryKey = "id_movimiento";

    protected $fillable = [
        'tipo',
        'cantidad',
        'motivo',
        'fecha',
        'id_producto',
    ];

    protected $casts = [
        'fecha' => 'date',
    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_producto', 'id_producto');
    }
}