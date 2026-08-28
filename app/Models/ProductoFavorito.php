<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductoFavorito extends Model
{
    use HasFactory;

    // Nombre exacto de la tabla en la base de datos
    protected $table = 'productos_favoritos';

    // Llave primaria personalizada
    protected $primaryKey = 'id_favorito';

    // Campos asignables en masa
    protected $fillable = [
        'id_usuario',
        'id_producto',
    ];

    // Relación: Un favorito pertenece a un usuario
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario', 'id_usuario');
    }

    // Relación: Un favorito pertenece a un producto
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_producto', 'id_producto');
    }
}