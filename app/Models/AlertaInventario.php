<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlertaInventario extends Model
{
    use HasFactory; 

    protected $table = "alertas_inventario";

    protected $primaryKey = "id_alerta"; 

    protected $fillable = [
        "id_producto",
        "mensaje",
        "leido",
    ];

    protected $casts = [
        'leido' => 'boolean', //verdadero/falso 
    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_producto', 'id_producto');
    }
}
