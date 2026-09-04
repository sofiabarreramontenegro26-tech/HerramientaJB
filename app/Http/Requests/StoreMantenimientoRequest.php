<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMantenimientoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'tipo_mantenimiento'  => 'required|string|in:preventivo,correctivo',
            'descripcion'         => 'required|string',
            'fecha'               => 'required|date',
            'tecnico_responsable' => 'nullable|string|max:100',
            'id_maquina'          => 'required|integer|exists:maquinas,id_maquina',
        ];
    }
}