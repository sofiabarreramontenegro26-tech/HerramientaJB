<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreConfiguracionAlertaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'dias_anticipacion_entrega' => ['required', 'integer', 'min:0'],
        ];
    }

    public function messages(): array
    {
        return [
            'dias_anticipacion_entrega.required' => 'El número de días de anticipación es obligatorio.',
            'dias_anticipacion_entrega.integer'  => 'Los días de anticipación deben ser un número entero.',
            'dias_anticipacion_entrega.min'      => 'Los días de anticipación no pueden ser un valor negativo.',
        ];
    }
}