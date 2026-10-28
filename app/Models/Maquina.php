<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Maquina extends Model
{
    use SoftDeletes;

    protected $table = 'maquinas';
    protected $primaryKey = 'id_maquina';

    protected $fillable = ['nombre', 'referencia', 'fecha_compra', 'id_proveedor'];

    protected $casts = [
        'fecha_compra' => 'date',
    ];

    public function proveedor(): BelongsTo
    {
        return $this->belongsTo(Proveedor::class, 'id_proveedor', 'id_proveedor')->withTrashed();
    }

    public function hojaVida(): HasOne
    {
        return $this->hasOne(HojaVida::class, 'id_maquina', 'id_maquina');
    }

    public function mantenimientos(): HasMany
    {
        return $this->hasMany(Mantenimiento::class, 'id_maquina', 'id_maquina');
    }

    public function ultimoMantenimiento(): HasOne
    {
        return $this->hasOne(Mantenimiento::class, 'id_maquina', 'id_maquina')->latestOfMany('fecha');
    }
}
