<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class AlertaInventario extends Model
{
    use SoftDeletes;

    protected $table = 'alertas_inventario';
    protected $primaryKey = 'id_alerta';

    protected $fillable = ['id_producto', 'mensaje', 'leido'];

    protected $casts = [
        'leido' => 'boolean',
    ];

    public function producto(): BelongsTo
    {
        return $this->belongsTo(Producto::class, 'id_producto', 'id_producto')->withTrashed();
    }

    public function scopeNoLeidas(Builder $query): Builder
    {
        return $query->where('leido', false);
    }
}
