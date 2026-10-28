<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class ConfiguracionAlerta extends Model
{
    use HasFactory,SoftDeletes; 

    protected $table = "configuracion_alertas";

    protected $primaryKey = "id_configuracion"; 

    protected $fillable = [
        "dias_anticipacion_entrega",
    ];

    protected $casts = [
        'dias_anticipacion_entrega' => 'integer',
    ];
}