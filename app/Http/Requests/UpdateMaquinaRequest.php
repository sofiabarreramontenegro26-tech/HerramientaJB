<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateMaquinaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // Obtenemos el ID de la máquina desde la ruta (URL)
        $maquinaId = $this->route('maquina') ?? $this->route('id_maquina') ?? $this->route('id');

        return [
            // $table->string('nombre', 100); -> Opcional en update, string, max 100
            'nombre' => ['sometimes', 'required', 'string', 'max:100'],

            // $table->string('referencia', 100)->unique(); -> Opcional en update, único ignorando el registro actual
            'referencia' => [
                'sometimes',
                'required',
                'string',
                'max:100',
                Rule::unique('maquinas', 'referencia')->ignore($maquinaId, 'id_maquina'),
            ],

            // $table->date('fecha_compra'); -> Opcional en update, fecha válida
            'fecha_compra' => ['sometimes', 'required', 'date'],

            // $table->foreignId('id_proveedor')->constrained('proveedores', 'id_proveedor'); -> Opcional en update, entero existente
            'id_proveedor' => ['sometimes', 'required', 'integer', 'exists:proveedores,id_proveedor'],
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre de la máquina no puede estar vacío.',
            'nombre.string'   => 'El nombre debe ser un texto válido.',
            'nombre.max'      => 'El nombre no puede superar los 100 caracteres.',

            'referencia.required' => 'La referencia de la máquina no puede estar vacía.',
            'referencia.string'   => 'La referencia debe ser un texto válido.',
            'referencia.max'      => 'La referencia no puede superar los 100 caracteres.',
            'referencia.unique'   => 'Ya existe otra máquina registrada con esa referencia.',

            'fecha_compra.required' => 'La fecha de compra no puede estar vacía.',
            'fecha_compra.date'     => 'La fecha de compra debe ser una fecha válida.',

            'id_proveedor.required' => 'El proveedor no puede estar vacío.',
            'id_proveedor.integer'  => 'El identificador del proveedor debe ser un entero.',
            'id_proveedor.exists'   => 'El proveedor seleccionado no existe.',
        ];
    }
}