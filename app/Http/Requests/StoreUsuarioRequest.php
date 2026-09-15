<?php

namespace App\Http\Requests\Usuario;

use Illuminate\Foundation\Http\FormRequest;

class StoreUsuarioRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // $table->string('nombre_completo', 100); -> NOT NULL, string, max 100
            'nombre_completo' => ['required', 'string', 'max:100'],

            // $table->string('correo', 100)->unique(); -> NOT NULL, formato email, max 100, único en la tabla usuarios
            'correo' => ['required', 'string', 'email', 'max:100', 'unique:usuarios,correo'],

            // $table->string('contraseña', 255); -> NOT NULL, string, mínimo recomendable de caracteres
            'contraseña' => ['required', 'string', 'min:8', 'max:255'],

            // $table->foreignId('id_rol')->nullable()->constrained('roles', 'id_rol'); -> NULLABLE, entero, debe existir en la columna 'id_rol' de la tabla 'roles'
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
            'correo.unique' => 'Ya existe un usuario registrado con este correo electrónico.',

            'contraseña.required' => 'La contraseña es obligatoria.',
            'contraseña.string' => 'La contraseña debe ser un texto válido.',
            'contraseña.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'contraseña.max' => 'La contraseña no puede superar los 255 caracteres.',

            'id_rol.integer' => 'El identificador del rol debe ser un número entero.',
            'id_rol.exists' => 'El rol seleccionado no existe en la base de datos.',
        ];
    }
}