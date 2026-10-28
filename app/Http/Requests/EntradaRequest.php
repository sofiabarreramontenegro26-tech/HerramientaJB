<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EntradaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id_producto' => ['required', 'integer', 'exists:productos,id_producto,deleted_at,NULL'],
            'id_proveedor' => ['required', 'integer', 'exists:proveedores,id_proveedor,deleted_at,NULL'],
            'cantidad' => ['required', 'integer', 'min:1', 'max:100000'],
            'fecha' => ['required', 'date', 'before_or_equal:today'],
        ];
    }

    public function attributes(): array
    {
        return [
            'id_producto' => 'producto',
            'id_proveedor' => 'proveedor',
        ];
    }
}
