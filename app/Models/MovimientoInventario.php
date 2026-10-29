<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class MovimientoInventario extends Model
{
    use SoftDeletes;

    public const ENTRADA = 'ENTRADA';
    public const SALIDA = 'SALIDA';

    protected $table = 'movimiento_inventario';
    protected $primaryKey = 'id_movimiento';

    protected $fillable = ['tipo', 'cantidad', 'motivo', 'fecha', 'id_producto'];

    protected $casts = [
        'cantidad' => 'integer',
        'fecha' => 'date',
    ];

    public function producto(): BelongsTo
    {
        return $this->belongsTo(Producto::class, 'id_producto', 'id_producto')->withTrashed();
    }

    public function esEntrada(): bool
    {
        return $this->tipo === self::ENTRADA;
    }
}
