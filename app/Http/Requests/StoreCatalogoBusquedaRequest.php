<?php

namespace App\Http\Requests\CatalogoBusqueda;

use Illuminate\Foundation\Http\FormRequest;

class StoreCatalogoBusquedaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id_producto' => ['required', 'integer', 'exists:productos,id_producto'],
            'destacado'   => ['nullable', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'id_producto.required' => 'Debes seleccionar un producto.',
            'id_producto.integer'  => 'El identificador del producto debe ser un número entero.',
            'id_producto.exists'   => 'El producto seleccionado no existe en la base de datos.',

            'destacado.boolean'    => 'El campo destacado debe ser un valor verdadero o falso.',
        ];
    }
}