<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HojaVidaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'fecha_ingreso' => ['required', 'date', 'before_or_equal:today'],
            'especificaciones_tecnicas' => ['nullable', 'string', 'max:5000'],
        ];
    }

    public function attributes(): array
    {
        return [
            'fecha_ingreso' => 'fecha de ingreso',
            'especificaciones_tecnicas' => 'especificaciones técnicas',
        ];
    }
}
