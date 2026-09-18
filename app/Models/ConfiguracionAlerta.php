<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfiguracionAlerta extends Model
{
    use HasFactory; 

    protected $table = "configuracion_alertas";

    protected $primaryKey = "id_configuracion"; 

    protected $fillable = [
        "dias_anticipacion_entrega",
    ];

    protected $casts = [
        'dias_anticipacion_entrega' => 'integer',
    ];
}