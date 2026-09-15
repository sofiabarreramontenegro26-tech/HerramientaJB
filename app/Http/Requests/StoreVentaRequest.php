<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVentaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'cliente'        => 'required|string|max:255',
            'fecha'          => 'required|date',
            'total_venta'    => 'required|numeric|min:0|between:0,99999999.99',
            'ganancia_total' => 'required|numeric|between:-99999999.99,99999999.99',
            'id_usuario'     => 'required|integer|exists:usuarios,id_usuario',
        ];
    }
}