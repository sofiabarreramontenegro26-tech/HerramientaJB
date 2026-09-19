<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRegistroConectividadRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // Obtenemos el ID del registro de conectividad desde la ruta (URL)
        $registroId = $this->route('registro_conectividad') ?? $this->route('id_registro_conectividad');

        return [
            // $table->boolean('estado_conexion'); -> Opcional en update, pero debe ser booleano
            'estado_conexion' => ['sometimes', 'required', 'boolean'],

            // $table->dateTime('fecha_registro'); -> Opcional en update, fecha y hora válida
            'fecha_registro' => ['sometimes', 'required', 'date'],
        ];
    }

    public function messages(): array
    {
        return [
            'estado_conexion.required' => 'El estado de la conexión no puede estar vacío.',
            'estado_conexion.boolean'  => 'El estado de la conexión debe ser verdadero o falso.',

            'fecha_registro.required'  => 'La fecha de registro no puede estar vacía.',
            'fecha_registro.date'      => 'La fecha de registro debe ser una fecha/hora válida.',
        ];
    }
}