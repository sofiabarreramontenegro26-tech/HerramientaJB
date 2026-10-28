<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Proveedor extends Model
{
    use SoftDeletes;

    protected $table = 'proveedores';
    protected $primaryKey = 'id_proveedor';

    protected $fillable = ['nombre', 'telefono', 'empresa'];

    public function productos(): HasMany
    {
        return $this->hasMany(Producto::class, 'id_proveedor', 'id_proveedor');
    }

    public function entradas(): HasMany
    {
        return $this->hasMany(Entrada::class, 'id_proveedor', 'id_proveedor');
    }

    public function maquinas(): HasMany
    {
        return $this->hasMany(Maquina::class, 'id_proveedor', 'id_proveedor');
    }
}
