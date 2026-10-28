<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCatalogoBusquedaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id_producto' => ['sometimes', 'integer', 'exists:productos,id_producto'],
            'destacado'   => ['sometimes', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'id_producto.integer'  => 'El identificador del producto debe ser un número entero.',
            'id_producto.exists'   => 'El producto seleccionado no existe en la base de datos.',

            'destacado.boolean'    => 'El campo destacado debe ser un valor verdadero o falso.',
        ];
    }
}