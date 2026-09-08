<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMantenimientoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'tipo_mantenimiento'  => 'sometimes|string|in:preventivo,correctivo',
            'descripcion'         => 'sometimes|string',
            'fecha'               => 'sometimes|date',
            'tecnico_responsable' => 'nullable|string|max:100',
            'id_maquina'          => 'sometimes|integer|exists:maquinas,id_maquina',
        ];
    }
}