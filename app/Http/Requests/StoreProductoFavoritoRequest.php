<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductoFavoritoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id_usuario'  => 'nullable|integer|exists:usuarios,id_usuario',
            'id_producto' => 'required|integer|exists:productos,id_producto',
        ];
    }
}