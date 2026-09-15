<?php

namespace App\Http\Requests\AlertaInventario;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAlertaInventarioRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id_producto' => ['sometimes', 'required', 'integer', 'exists:productos,id_producto'],
            'mensaje'     => ['sometimes', 'required', 'string', 'max:255'],
            'leido'       => ['sometimes', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'id_producto.required' => 'El producto es obligatorio si decide actualizarse.',
            'id_producto.integer'  => 'El identificador del producto debe ser un número entero.',
            'id_producto.exists'   => 'El producto seleccionado no existe en la base de datos.',

            'mensaje.required'     => 'El mensaje de la alerta es obligatorio si decide actualizarse.',
            'mensaje.string'       => 'El mensaje de la alerta debe ser un texto válido.',
            'mensaje.max'          => 'El mensaje de la alerta no puede superar los 255 caracteres.',

            'leido.boolean'        => 'El estado de leído debe ser un valor verdadero o falso.',
        ];
    }
}