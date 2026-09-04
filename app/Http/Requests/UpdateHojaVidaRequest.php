<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateHojaVidaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'fecha_ingreso'            => 'sometimes|date',
            'especificaciones_tecnicas' => 'nullable|string',
            'id_maquina'               => 'sometimes|integer|exists:maquinas,id_maquina',
        ];
    }
}