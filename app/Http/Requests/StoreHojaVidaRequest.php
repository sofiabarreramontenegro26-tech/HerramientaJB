<?php

namespace App\Http\Requests\HojaVida;

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
            // $table->date('fecha_ingreso'); -> NOT NULL, fecha válida
            'fecha_ingreso' => ['required', 'date'],

            // $table->text('especificaciones_tecnicas')->nullable(); -> Opcional, string
            'especificaciones_tecnicas' => ['nullable', 'string'],

            // $table->foreignId('id_maquina')->constrained('maquinas', 'id_maquina'); -> NOT NULL, entero, existe en maquinas
            'id_maquina' => ['required', 'integer', 'exists:maquinas,id_maquina'],
        ];
    }

    public function messages(): array
    {
        return [
            'fecha_ingreso.required' => 'La fecha de ingreso es obligatoria.',
            'fecha_ingreso.date'     => 'La fecha de ingreso debe ser una fecha válida.',

            'especificaciones_tecnicas.string' => 'Las especificaciones técnicas deben ser un texto válido.',

            'id_maquina.required' => 'La máquina asociada es obligatoria.',
            'id_maquina.integer'  => 'El identificador de la máquina debe ser un entero.',
            'id_maquina.exists'   => 'La máquina seleccionada no existe.',
        ];
    }
}