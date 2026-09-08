<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreHojaVidaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'fecha_ingreso'            => 'required|date',
            'especificaciones_tecnicas' => 'nullable|string',
            'id_maquina'               => 'required|integer|exists:maquinas,id_maquina',
        ];
    }
}