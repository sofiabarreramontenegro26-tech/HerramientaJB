<?php

namespace App\Http\Requests\HistorialActividad;

use Illuminate\Foundation\Http\FormRequest;

class UpdateHistorialActividadRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // 'sometimes' permite actualizar solo los campos que se envíen
            'accion' => ['sometimes', 'required', 'string'],
            'id_usuario' => ['sometimes', 'required', 'integer', 'exists:usuarios,id_usuario'],
        ];
    }

    public function messages(): array
    {
        return [
            'accion.required' => 'La descripción de la acción es obligatoria.',
            'accion.string' => 'La acción debe ser un texto válido.',

            'id_usuario.required' => 'El usuario asociado es obligatorio.',
            'id_usuario.integer' => 'El identificador de usuario debe ser un número entero.',
            'id_usuario.exists' => 'El usuario seleccionado no existe en la base de datos.',
        ];
    }
}