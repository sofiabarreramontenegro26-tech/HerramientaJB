<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAlertaInventarioRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id_producto' => ['sometimes', 'integer', 'exists:productos,id_producto'],
            'mensaje'     => ['sometimes', 'string', 'max:255'],
            'leido'       => ['sometimes', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'id_producto.integer'  => 'El identificador del producto debe ser un número entero.',
            'id_producto.exists'   => 'El producto seleccionado no existe en la base de datos.',

            'mensaje.string'       => 'El mensaje de la alerta debe ser un texto válido.',
            'mensaje.max'          => 'El mensaje de la alerta no puede superar los 255 caracteres.',

            'leido.boolean'        => 'El estado de leído debe ser un valor verdadero o falso.',
        ];
    }
}