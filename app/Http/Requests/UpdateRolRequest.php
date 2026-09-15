<?php

namespace App\Http\Requests\Rol;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRolRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // Obtenemos el ID del rol desde la ruta (URL)
        $rolId = $this->route('rol') ?? $this->route('id_rol');

        return [
            'nombre' => [
                'sometimes',
                'required',
                'string',
                'max:100',
                // Ignora el registro actual en la tabla 'roles' usando la PK 'id_rol'
                Rule::unique('roles', 'nombre')->ignore($rolId, 'id_rol'),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre del rol es obligatorio.',
            'nombre.string' => 'El nombre del rol debe ser un texto válido.',
            'nombre.max' => 'El nombre del rol no puede superar los 100 caracteres.',
            'nombre.unique' => 'Ya existe otro rol registrado con ese nombre.',
        ];
    }
}