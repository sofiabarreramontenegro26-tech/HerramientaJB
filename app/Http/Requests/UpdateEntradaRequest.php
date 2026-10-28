<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEntradaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'cantidad' => ['sometimes', 'integer', 'min:1'],
            'fecha' => ['sometimes',  'date'],
            'id_producto' => ['sometimes', 'integer', 'exists:productos,id_producto'],
            'id_proveedor' => ['sometimes', 'integer', 'exists:proveedores,id_proveedor'],
        ];
    }

    public function messages(): array
    {
        return [
            'cantidad.integer' => 'La cantidad debe ser un número entero.',
            'cantidad.min' => 'La cantidad debe ser al menos 1.',

            'fecha.date' => 'La fecha ingresada no tiene un formato válido.',

            'id_producto.integer' => 'El identificador del producto debe ser un número entero.',
            'id_producto.exists' => 'El producto seleccionado no existe en la base de datos.',

            'id_proveedor.integer' => 'El identificador del proveedor debe ser un número entero.',
            'id_proveedor.exists' => 'El proveedor seleccionado no existe en la base de datos.',
        ];
    }
}