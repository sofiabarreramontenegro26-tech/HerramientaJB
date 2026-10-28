<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Venta extends Model
{
    use SoftDeletes;

    protected $table = 'ventas';
    protected $primaryKey = 'id_venta';

    protected $fillable = ['cliente', 'fecha', 'total_venta', 'ganancia_total', 'id_usuario'];

    protected $casts = [
        'fecha' => 'date',
        'total_venta' => 'decimal:2',
        'ganancia_total' => 'decimal:2',
    ];

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'id_usuario', 'id_usuario')->withTrashed();
    }

    /**
     * Texto que se guarda en movimiento_inventario.motivo para enlazar
     * las salidas de stock con esta venta (la tabla ventas no tiene detalle).
     */
    public function motivoMovimiento(): string
    {
        return 'Venta #' . $this->id_venta;
    }
}
