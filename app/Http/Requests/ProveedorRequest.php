<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProveedorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre' => ['required', 'string', 'max:100'],
            'telefono' => ['nullable', 'string', 'max:20', 'regex:/^[0-9+\-\s()]+$/'],
            'empresa' => ['nullable', 'string', 'max:100'],
        ];
    }

    public function messages(): array
    {
        return [
            'telefono.regex' => 'El teléfono solo puede tener números, espacios, +, - y paréntesis.',
        ];
    }
}
