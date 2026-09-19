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
            // $table->enum('tipo_mantenimiento', ['preventivo', 'correctivo']); -> NOT NULL, string, valores permitidos
            'tipo_mantenimiento' => ['required', 'string', 'in:preventivo,correctivo'],

            // $table->text('descripcion'); -> NOT NULL, string
            'descripcion' => ['required', 'string'],

            // $table->date('fecha'); -> NOT NULL, fecha válida
            'fecha' => ['required', 'date'],

            // $table->string('tecnico_responsable', 100)->nullable(); -> Opcional, string, max 100
            'tecnico_responsable' => ['nullable', 'string', 'max:100'],

            // $table->foreignId('id_maquina')->constrained('maquinas', 'id_maquina'); -> NOT NULL, entero, existe en maquinas
            'id_maquina' => ['required', 'integer', 'exists:maquinas,id_maquina'],
        ];
    }

    public function messages(): array
    {
        return [
            'tipo_mantenimiento.required' => 'El tipo de mantenimiento es obligatorio.',
            'tipo_mantenimiento.string'   => 'El tipo de mantenimiento debe ser un texto válido.',
            'tipo_mantenimiento.in'       => 'El tipo de mantenimiento solo puede ser preventivo o correctivo.',

            'descripcion.required' => 'La descripción del mantenimiento es obligatoria.',
            'descripcion.string'   => 'La descripción debe ser un texto válido.',

            'fecha.required' => 'La fecha del mantenimiento es obligatoria.',
            'fecha.date'     => 'La fecha debe ser una fecha válida.',

            'tecnico_responsable.string' => 'El nombre del técnico responsable debe ser un texto válido.',
            'tecnico_responsable.max'    => 'El nombre del técnico no puede superar los 100 caracteres.',

            'id_maquina.required' => 'La máquina asociada es obligatoria.',
            'id_maquina.integer'  => 'El identificador de la máquina debe ser un entero.',
            'id_maquina.exists'   => 'La máquina seleccionada no existe.',
        ];
    }
}