<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProveedorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // 'sometimes' permite actualizar parcialmente solo los campos enviados
            'nombre' => ['sometimes', 'string', 'max:100'],
            'telefono' => ['nullable', 'string', 'max:20'],
            'empresa' => ['nullable', 'string', 'max:100'],
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.string' => 'El nombre debe ser un texto válido.',
            'nombre.max' => 'El nombre no puede superar los 100 caracteres.',

            'telefono.string' => 'El teléfono debe ser un texto válido.',
            'telefono.max' => 'El teléfono no puede superar los 20 caracteres.',

            'empresa.string' => 'El nombre de la empresa debe ser un texto válido.',
            'empresa.max' => 'El nombre de la empresa no puede superar los 100 caracteres.',
        ];
    }
}