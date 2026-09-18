<?php

namespace App\Http\Requests\HojaVida;

use Illuminate\Foundation\Http\FormRequest;

class UpdateHojaVidaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // Obtenemos el ID de la hoja de vida desde la ruta (URL)
        $hojaVidaId = $this->route('hoja_vida') ?? $this->route('id_hoja_vida') ?? $this->route('id');

        return [
            // $table->date('fecha_ingreso'); -> Opcional en update, fecha válida
            'fecha_ingreso' => ['sometimes', 'required', 'date'],

            // $table->text('especificaciones_tecnicas')->nullable(); -> Opcional, string
            'especificaciones_tecnicas' => ['nullable', 'string'],

            // $table->foreignId('id_maquina')->constrained('maquinas', 'id_maquina'); -> Opcional en update, entero existente
            'id_maquina' => ['sometimes', 'required', 'integer', 'exists:maquinas,id_maquina'],
        ];
    }

    public function messages(): array
    {
        return [
            'fecha_ingreso.required' => 'La fecha de ingreso no puede estar vacía.',
            'fecha_ingreso.date'     => 'La fecha de ingreso debe ser una fecha válida.',

            'especificaciones_tecnicas.string' => 'Las especificaciones técnicas deben ser un texto válido.',

            'id_maquina.required' => 'La máquina asociada no puede estar vacía.',
            'id_maquina.integer'  => 'El identificador de la máquina debe ser un entero.',
            'id_maquina.exists'   => 'La máquina seleccionada no existe.',
        ];
    }
}