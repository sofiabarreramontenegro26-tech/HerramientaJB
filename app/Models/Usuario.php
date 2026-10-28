<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable
{
    use SoftDeletes;

    protected $table = 'usuarios';
    protected $primaryKey = 'id_usuario';

    protected $fillable = [
        'nombre_completo',
        'correo',
        'contraseña',
        'id_rol',
    ];

    protected $hidden = [
        'contraseña',
    ];

    protected $with = ['rol'];

    /**
     * La columna de la contraseña se llama "contraseña" (no "password").
     * Laravel 11+ lee esta propiedad para validar y re-encriptar la clave.
     */
    protected $authPasswordName = 'contraseña';

    /**
     * La tabla no tiene columna remember_token; se desactiva "recordarme".
     */
    protected $rememberTokenName = '';

    public function getAuthPassword(): string
    {
        return (string) $this->getAttribute('contraseña');
    }

    public function rol(): BelongsTo
    {
        return $this->belongsTo(Rol::class, 'id_rol', 'id_rol');
    }

    public function ventas(): HasMany
    {
        return $this->hasMany(Venta::class, 'id_usuario', 'id_usuario');
    }

    public function actividades(): HasMany
    {
        return $this->hasMany(HistorialActividad::class, 'id_usuario', 'id_usuario');
    }

    public function tieneRol(string ...$roles): bool
    {
        return $this->rol !== null && in_array($this->rol->slug, $roles, true);
    }

    public function esAdministrador(): bool
    {
        return $this->tieneRol(Rol::ADMINISTRADOR);
    }

    public function esTecnico(): bool
    {
        return $this->tieneRol(Rol::TECNICO);
    }

    public function getIniciales(): string
    {
        $partes = preg_split('/\s+/', trim($this->nombre_completo)) ?: [];

        return mb_strtoupper(collect($partes)->take(2)->map(fn ($p) => mb_substr($p, 0, 1))->implode(''));
    }
}
