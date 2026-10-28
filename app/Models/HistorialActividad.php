<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class HistorialActividad extends Model
{
    use SoftDeletes;

    protected $table = 'historial_actividades';
    protected $primaryKey = 'id_historial';

    protected $fillable = ['accion', 'id_usuario'];

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'id_usuario', 'id_usuario')->withTrashed();
    }
}
