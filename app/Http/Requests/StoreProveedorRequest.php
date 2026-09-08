<?php

namespace App\Http\Requests\Proveedor;

use Illuminate\Foundation\Http\FormRequest;

class StoreProveedorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // $table->string('nombre', 100); -> NOT NULL, string, max 100
            'nombre' => ['required', 'string', 'max:100'],

            // $table->string('telefono', 20)->nullable(); -> Opcional, string, max 20
            'telefono' => ['nullable', 'string', 'max:20'],

            // $table->string('empresa', 100)->nullable(); -> Opcional, string, max 100
            'empresa' => ['nullable', 'string', 'max:100'],
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre del proveedor es obligatorio.',
            'nombre.string' => 'El nombre debe ser un texto válido.',
            'nombre.max' => 'El nombre no puede superar los 100 caracteres.',

            'telefono.string' => 'El teléfono debe ser un texto válido.',
            'telefono.max' => 'El teléfono no puede superar los 20 caracteres.',

            'empresa.string' => 'El nombre de la empresa debe ser un texto válido.',
            'empresa.max' => 'El nombre de la empresa no puede superar los 100 caracteres.',
        ];
    }
}