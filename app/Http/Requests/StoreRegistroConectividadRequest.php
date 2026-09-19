<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRegistroConectividadRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // $table->boolean('estado_conexion'); -> NOT NULL, booleano (true/false, 1/0)
            'estado_conexion' => ['required', 'boolean'],

            // $table->dateTime('fecha_registro'); -> NOT NULL, fecha y hora válida
            'fecha_registro' => ['required', 'date'],
        ];
    }

    public function messages(): array
    {
        return [
            'estado_conexion.required' => 'El estado de la conexión es obligatorio.',
            'estado_conexion.boolean'  => 'El estado de la conexión debe ser verdadero o falso.',

            'fecha_registro.required'  => 'La fecha de registro es obligatoria.',
            'fecha_registro.date'      => 'La fecha de registro debe ser una fecha/hora válida.',
        ];
    }
}