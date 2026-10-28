<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SalidaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id_producto' => ['required', 'integer', 'exists:productos,id_producto,deleted_at,NULL'],
            'cantidad' => ['required', 'integer', 'min:1', 'max:100000'],
            'motivo' => ['required', 'string', 'max:255'],
            'fecha' => ['required', 'date', 'before_or_equal:today'],
        ];
    }

    public function attributes(): array
    {
        return [
            'id_producto' => 'producto',
        ];
    }
}
