<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CotizacionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'cliente_telefono' => ['nullable', 'string', 'max:20', 'regex:/^[0-9+\-\s()]+$/'],
            'items' => ['required', 'array', 'min:1'],
            'items.*.id_producto' => ['required', 'integer', 'exists:productos,id_producto,deleted_at,NULL'],
            'items.*.cantidad' => ['required', 'integer', 'min:1', 'max:100000'],
        ];
    }

    public function attributes(): array
    {
        return [
            'cliente_telefono' => 'teléfono del cliente',
            'items' => 'productos',
            'items.*.id_producto' => 'producto',
            'items.*.cantidad' => 'cantidad',
        ];
    }

    public function messages(): array
    {
        return [
            'items.required' => 'Agrega al menos un producto.',
        ];
    }
}
