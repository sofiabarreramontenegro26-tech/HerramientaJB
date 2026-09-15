<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCotizacionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'cliente_telefono'        => 'nullable|string|max:255',
            'productos_seleccionados' => 'sometimes|array',
            'total'                   => 'sometimes|numeric|min:0|between:0,99999999.99',
        ];
    }
}