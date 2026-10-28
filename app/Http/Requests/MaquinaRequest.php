<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MaquinaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $maquina = $this->route('maquina');

        return [
            'nombre' => ['required', 'string', 'max:100'],
            'referencia' => [
                'required',
                'string',
                'max:100',
                Rule::unique('maquinas', 'referencia')->ignore($maquina?->id_maquina, 'id_maquina'),
            ],
            'fecha_compra' => ['required', 'date', 'before_or_equal:today'],
            'id_proveedor' => ['required', 'integer', 'exists:proveedores,id_proveedor,deleted_at,NULL'],
        ];
    }

    public function attributes(): array
    {
        return [
            'fecha_compra' => 'fecha de compra',
            'id_proveedor' => 'proveedor',
        ];
    }
}
