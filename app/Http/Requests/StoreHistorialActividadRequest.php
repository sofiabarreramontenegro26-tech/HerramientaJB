<?php

namespace App\Http\Requests\HistorialActividad;

use Illuminate\Foundation\Http\FormRequest;

class StoreHistorialActividadRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // $table->text('accion'); -> NOT NULL, debe ser un texto
            'accion' => ['required', 'string'],

            // $table->foreignId('id_usuario')->constrained('usuarios', 'id_usuario');
            // NOT NULL, entero, debe existir en la columna 'id_usuario' de la tabla 'usuarios'
            'id_usuario' => ['required', 'integer', 'exists:usuarios,id_usuario'],
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