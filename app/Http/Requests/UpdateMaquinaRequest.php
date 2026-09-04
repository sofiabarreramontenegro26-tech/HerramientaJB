<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMaquinaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // Se obtiene el ID del parámetro de la ruta para ignorar la regla unique en la actualización
        $idMaquina = $this->route('maquina') ?? $this->route('id');

        return [
            'nombre'       => 'sometimes|string|max:100',
            'referencia'   => 'sometimes|string|max:100|unique:maquinas,referencia,' . $idMaquina . ',id_maquina',
            'fecha_compra' => 'sometimes|date',
            'id_proveedor' => 'sometimes|integer|exists:proveedores,id_proveedor',
        ];
    }
}