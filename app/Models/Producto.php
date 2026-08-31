<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Producto extends Model
{
    use HasFactory;

    protected $table = "productos";

    protected $primaryKey = "id_producto";

    protected $fillable = [
        "nombre",
        "descripcion",
        "marca",
        "imagen",
        "cantidad",
        "stock_minimo",
        "precio_compra",
        "precio_venta",
        "id_categoria", // <-- Llave foránea incluida
        "id_proveedor"  // <-- Llave foránea incluida
    ];

    protected $casts = [
        "cantidad" => "integer",
        "stock_minimo" => "integer",
        "precio_compra" => "decimal:2",
        "precio_venta" => "decimal:2"
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'id_categoria', 'id_categoria');
    }

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'id_proveedor', 'id_proveedor');
    }
}