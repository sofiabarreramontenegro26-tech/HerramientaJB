<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVentaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'cliente'        => 'sometimes|string|max:255',
            'fecha'          => 'sometimes|date',
            'total_venta'    => 'sometimes|numeric|min:0|between:0,99999999.99',
            'ganancia_total' => 'sometimes|numeric|between:-99999999.99,99999999.99',
            'id_usuario'     => 'sometimes|integer|exists:usuarios,id_usuario',
        ];
    }
}