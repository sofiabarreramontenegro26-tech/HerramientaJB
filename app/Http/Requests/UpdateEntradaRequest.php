<?php

namespace App\Http\Requests\Entrada;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEntradaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'cantidad' => ['sometimes', 'required', 'integer', 'min:1'],
            'fecha' => ['sometimes', 'required', 'date'],
            'id_producto' => ['sometimes', 'required', 'integer', 'exists:productos,id_producto'],
            'id_proveedor' => ['sometimes', 'required', 'integer', 'exists:proveedores,id_proveedor'],
        ];
    }

    public function messages(): array
    {
        return [
            'cantidad.required' => 'La cantidad es obligatoria si decide actualizarse.',
            'cantidad.integer' => 'La cantidad debe ser un número entero.',
            'cantidad.min' => 'La cantidad debe ser al menos 1.',

            'fecha.required' => 'La fecha es obligatoria si decide actualizarse.',
            'fecha.date' => 'La fecha ingresada no tiene un formato válido.',

            'id_producto.required' => 'El producto es obligatorio si decide actualizarse.',
            'id_producto.integer' => 'El identificador del producto debe ser un número entero.',
            'id_producto.exists' => 'El producto seleccionado no existe en la base de datos.',

            'id_proveedor.required' => 'El proveedor es obligatorio si decide actualizarse.',
            'id_proveedor.integer' => 'El identificador del proveedor debe ser un número entero.',
            'id_proveedor.exists' => 'El proveedor seleccionado no existe en la base de datos.',
        ];
    }
}