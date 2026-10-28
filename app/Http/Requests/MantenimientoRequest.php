<?php

namespace App\Http\Requests;

use App\Models\Mantenimiento;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MantenimientoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id_maquina' => ['required', 'integer', 'exists:maquinas,id_maquina,deleted_at,NULL'],
            'tipo_mantenimiento' => ['required', Rule::in(Mantenimiento::TIPOS)],
            'descripcion' => ['required', 'string', 'max:5000'],
            'fecha' => ['required', 'date', 'before_or_equal:today'],
            'tecnico_responsable' => ['nullable', 'string', 'max:100'],
        ];
    }

    public function attributes(): array
    {
        return [
            'id_maquina' => 'máquina',
            'tipo_mantenimiento' => 'tipo de mantenimiento',
            'tecnico_responsable' => 'técnico responsable',
        ];
    }
}
