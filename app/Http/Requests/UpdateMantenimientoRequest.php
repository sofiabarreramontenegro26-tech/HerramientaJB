<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMantenimientoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // Obtenemos el ID del mantenimiento desde la ruta (URL)
        $mantenimientoId = $this->route('mantenimiento') ?? $this->route('id_mantenimiento') ?? $this->route('id');

        return [
            // $table->enum('tipo_mantenimiento', ['preventivo', 'correctivo']); -> Opcional en update, string, valores permitidos
            'tipo_mantenimiento' => ['sometimes', 'required', 'string', 'in:preventivo,correctivo'],

            // $table->text('descripcion'); -> Opcional en update, string
            'descripcion' => ['sometimes', 'required', 'string'],

            // $table->date('fecha'); -> Opcional en update, fecha válida
            'fecha' => ['sometimes', 'required', 'date'],

            // $table->string('tecnico_responsable', 100)->nullable(); -> Opcional, string, max 100
            'tecnico_responsable' => ['nullable', 'string', 'max:100'],

            // $table->foreignId('id_maquina')->constrained('maquinas', 'id_maquina'); -> Opcional en update, entero existente
            'id_maquina' => ['sometimes', 'required', 'integer', 'exists:maquinas,id_maquina'],
        ];
    }

    public function messages(): array
    {
        return [
            'tipo_mantenimiento.required' => 'El tipo de mantenimiento no puede estar vacío.',
            'tipo_mantenimiento.string'   => 'El tipo de mantenimiento debe ser un texto válido.',
            'tipo_mantenimiento.in'       => 'El tipo de mantenimiento solo puede ser preventivo o correctivo.',

            'descripcion.required' => 'La descripción del mantenimiento no puede estar vacía.',
            'descripcion.string'   => 'La descripción debe ser un texto válido.',

            'fecha.required' => 'La fecha del mantenimiento no puede estar vacía.',
            'fecha.date'     => 'La fecha debe ser una fecha válida.',

            'tecnico_responsable.string' => 'El nombre del técnico responsable debe ser un texto válido.',
            'tecnico_responsable.max'    => 'El nombre del técnico no puede superar los 100 caracteres.',

            'id_maquina.required' => 'La máquina asociada no puede estar vacía.',
            'id_maquina.integer'  => 'El identificador de la máquina debe ser un entero.',
            'id_maquina.exists'   => 'La máquina seleccionada no existe.',
        ];
    }
}