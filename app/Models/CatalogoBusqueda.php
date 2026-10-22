<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class CatalogoBusqueda extends Model
{
    use HasFactory,SoftDeletes;

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