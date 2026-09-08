<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMaquinaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre'       => 'required|string|max:100',
            'referencia'   => 'required|string|max:100|unique:maquinas,referencia',
            'fecha_compra' => 'required|date',
            'id_proveedor' => 'required|integer|exists:proveedores,id_proveedor',
        ];
    }
}