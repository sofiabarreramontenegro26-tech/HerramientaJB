<?php

namespace App\Http\Requests\Usuario;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUsuarioRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // Obtenemos el ID del usuario desde los parámetros de la ruta (URL)
        $usuarioId = $this->route('usuario') ?? $this->route('id_usuario');

        return [
            'nombre_completo' => ['sometimes', 'required', 'string', 'max:100'],

            // Se ignora la restricción 'unique' para el ID del usuario actual
            'correo' => [
                'sometimes',
                'required',
                'string',
                'email',
                'max:100',
                Rule::unique('usuarios', 'correo')->ignore($usuarioId, 'id_usuario'),
            ],

            // En edición la contraseña suele ser opcional ('nullable')
            'contraseña' => ['nullable', 'string', 'min:8', 'max:255'],

            'id_rol' => ['nullable', 'integer', 'exists:roles,id_rol'],
        ];
    }

    public function messages(): array
    {
        return [
            'nombre_completo.required' => 'El nombre completo es obligatorio.',
            'nombre_completo.string' => 'El nombre completo debe ser un texto válido.',
            'nombre_completo.max' => 'El nombre completo no puede superar los 100 caracteres.',

            'correo.required' => 'El correo electrónico es obligatorio.',
            'correo.string' => 'El correo electrónico debe ser un texto válido.',
            'correo.email' => 'Debes ingresar un correo electrónico válido.',
            'correo.max' => 'El correo electrónico no puede superar los 100 caracteres.',
            'correo.unique' => 'Ya existe otro usuario registrado con este correo electrónico.',

            'contraseña.string' => 'La contraseña debe ser un texto válido.',
            'contraseña.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'contraseña.max' => 'La contraseña no puede superar los 255 caracteres.',

            'id_rol.integer' => 'El identificador del rol debe ser un número entero.',
            'id_rol.exists' => 'El rol seleccionado no existe en la base de datos.',
        ];
    }
}