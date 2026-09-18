<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatalogoBusqueda extends Model
{
    use HasFactory;

    protected $table = "catalogo_busquedas";

    protected $primaryKey = "id_catalogo"; 

    protected $fillable = [
        "id_producto",
        "destacado",
    ];

    protected $casts = [
        'destacado' => 'boolean', 
    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_producto', 'id_producto');
    }
}