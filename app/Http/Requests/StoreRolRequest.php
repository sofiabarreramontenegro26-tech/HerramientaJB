<?php

namespace App\Http\Requests\Rol;

use Illuminate\Foundation\Http\FormRequest;

class StoreRolRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // 'required': porque en la migración no es nullable
            // 'string': porque es tipo string en la migración
            // 'max:100': porque en la migración definiste $table->string('nombre', 100)
            // 'unique:roles,nombre': para evitar que se repitan nombres de rol en la tabla 'roles'
            'nombre' => ['required', 'string', 'max:100', 'unique:roles,nombre'],
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre del rol es obligatorio.',
            'nombre.string' => 'El nombre del rol debe ser un texto válido.',
            'nombre.max' => 'El nombre del rol no puede superar los 100 caracteres.',
            'nombre.unique' => 'Ya existe un rol registrado con ese nombre.',
        ];
    }
}