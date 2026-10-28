<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Rol extends Model
{
    use SoftDeletes;

    public const ADMINISTRADOR = 'administrador';
    public const TECNICO = 'tecnico';

    protected $table = 'roles';
    protected $primaryKey = 'id_rol';

    protected $fillable = ['nombre'];

    public function usuarios(): HasMany
    {
        return $this->hasMany(Usuario::class, 'id_rol', 'id_rol');
    }

    /**
     * Nombre normalizado sin tildes ni mayúsculas: "Técnico" => "tecnico".
     */
    public function getSlugAttribute(): string
    {
        return Str::slug($this->nombre);
    }
}
