<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Producto extends Model
{
    use SoftDeletes;

    protected $table = 'productos';
    protected $primaryKey = 'id_producto';

    protected $fillable = [
        'nombre',
        'descripcion',
        'marca',
        'imagen',
        'cantidad',
        'stock_minimo',
        'precio_compra',
        'precio_venta',
        'id_categoria',
        'id_proveedor',
    ];

    protected $casts = [
        'cantidad' => 'integer',
        'stock_minimo' => 'integer',
        'precio_compra' => 'decimal:2',
        'precio_venta' => 'decimal:2',
    ];

    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Categoria::class, 'id_categoria', 'id_categoria');
    }

    public function proveedor(): BelongsTo
    {
        return $this->belongsTo(Proveedor::class, 'id_proveedor', 'id_proveedor');
    }

    public function movimientos(): HasMany
    {
        return $this->hasMany(MovimientoInventario::class, 'id_producto', 'id_producto');
    }

    public function entradas(): HasMany
    {
        return $this->hasMany(Entrada::class, 'id_producto', 'id_producto');
    }

    public function alertas(): HasMany
    {
        return $this->hasMany(AlertaInventario::class, 'id_producto', 'id_producto');
    }

    public function scopeStockBajo(Builder $query): Builder
    {
        return $query->whereColumn('cantidad', '<=', 'stock_minimo');
    }

    public function scopeBuscar(Builder $query, ?string $texto): Builder
    {
        if (blank($texto)) {
            return $query;
        }

        return $query->where(function (Builder $q) use ($texto) {
            $q->where('nombre', 'like', "%{$texto}%")
                ->orWhere('marca', 'like', "%{$texto}%")
                ->orWhere('descripcion', 'like', "%{$texto}%");
        });
    }

    public function tieneStockBajo(): bool
    {
        return $this->cantidad <= $this->stock_minimo;
    }

    public function getImagenUrlAttribute(): ?string
    {
        return $this->imagen ? Storage::url($this->imagen) : null;
    }
}
