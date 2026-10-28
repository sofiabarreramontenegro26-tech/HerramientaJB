<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMaquinaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // $table->string('nombre', 100); -> NOT NULL, string, max 100
            'nombre' => ['required', 'string', 'max:100'],

            // $table->string('referencia', 100)->unique(); -> NOT NULL, string, max 100, único
            'referencia' => ['required', 'string', 'max:100', 'unique:maquinas,referencia'],

            // $table->date('fecha_compra'); -> NOT NULL, fecha válida
            'fecha_compra' => ['required', 'date'],

            // $table->foreignId('id_proveedor')->constrained('proveedores', 'id_proveedor'); -> NOT NULL, entero, existe en proveedores
            'id_proveedor' => ['required', 'integer', 'exists:proveedores,id_proveedor'],
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre de la máquina es obligatorio.',
            'nombre.string'   => 'El nombre debe ser un texto válido.',
            'nombre.max'      => 'El nombre no puede superar los 100 caracteres.',

            'referencia.required' => 'La referencia de la máquina es obligatoria.',
            'referencia.string'   => 'La referencia debe ser un texto válido.',
            'referencia.max'      => 'La referencia no puede superar los 100 caracteres.',
            'referencia.unique'   => 'Esta referencia ya se encuentra registrada.',

            'fecha_compra.required' => 'La fecha de compra es obligatoria.',
            'fecha_compra.date'     => 'La fecha de compra debe ser una fecha válida.',

            'id_proveedor.required' => 'El proveedor es obligatorio.',
            'id_proveedor.integer'  => 'El identificador del proveedor debe ser un entero.',
            'id_proveedor.exists'   => 'El proveedor seleccionado no existe.',
        ];
    }
}