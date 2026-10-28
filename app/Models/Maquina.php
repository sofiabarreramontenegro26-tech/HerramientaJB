<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Maquina extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = "maquinas";

    protected $primaryKey = "id_maquina";

    protected $fillable = [
        "nombre",
        "referencia",
        "fecha_compra",
        "id_proveedor",
    ];

    protected $casts = [
        'fecha_compra' => 'date',
    ];

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'id_proveedor', 'id_proveedor');
    }
}