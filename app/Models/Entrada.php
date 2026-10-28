<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Entrada extends Model
{
    use SoftDeletes;

    protected $table = 'entradas';
    protected $primaryKey = 'id_entrada';

    protected $fillable = ['cantidad', 'fecha', 'id_producto', 'id_proveedor'];

    protected $casts = [
        'cantidad' => 'integer',
        'fecha' => 'date',
    ];

    public function producto(): BelongsTo
    {
        return $this->belongsTo(Producto::class, 'id_producto', 'id_producto')->withTrashed();
    }

    public function proveedor(): BelongsTo
    {
        return $this->belongsTo(Proveedor::class, 'id_proveedor', 'id_proveedor')->withTrashed();
    }
}
