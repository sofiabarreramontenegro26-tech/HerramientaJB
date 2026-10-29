<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mantenimiento extends Model
{
    use SoftDeletes;

    public const PREVENTIVO = 'preventivo';
    public const CORRECTIVO = 'correctivo';
    public const TIPOS = [self::PREVENTIVO, self::CORRECTIVO];

    protected $table = 'mantenimientos';
    protected $primaryKey = 'id_mantenimiento';

    protected $fillable = [
        'tipo_mantenimiento',
        'descripcion',
        'fecha',
        'tecnico_responsable',
        'id_maquina',
    ];

    protected $casts = [
        'fecha' => 'date',
    ];

    public function maquina(): BelongsTo
    {
        return $this->belongsTo(Maquina::class, 'id_maquina', 'id_maquina')->withTrashed();
    }
}
