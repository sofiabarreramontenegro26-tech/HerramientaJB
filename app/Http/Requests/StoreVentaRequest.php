<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVentaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // $table->string('cliente', 255); -> NOT NULL, string, max 255
            'cliente' => ['required', 'string', 'max:255'],

            // $table->dateTime('fecha'); -> NOT NULL, fecha/hora válida
            'fecha' => ['required', 'date'],

            // $table->decimal('total_venta', 10, 2); -> NOT NULL, numérico, mínimo 0, entre 0 y 99999999.99
            'total_venta' => ['required', 'numeric', 'min:0', 'between:0,99999999.99'],

            // $table->decimal('ganancia_total', 10, 2); -> NOT NULL, numérico, entre -99999999.99 y 99999999.99
            'ganancia_total' => ['required', 'numeric', 'between:-99999999.99,99999999.99'],

            // $table->foreignId('id_usuario')->constrained('usuarios', 'id_usuario'); -> NOT NULL, entero, existe en usuarios
            'id_usuario' => ['required', 'integer', 'exists:usuarios,id_usuario'],
        ];
    }

    public function messages(): array
    {
        return [
            'cliente.required' => 'El nombre del cliente es obligatorio.',
            'cliente.string' => 'El nombre del cliente debe ser un texto válido.',
            'cliente.max' => 'El nombre del cliente no puede superar los 255 caracteres.',

            'fecha.required' => 'La fecha de la venta es obligatoria.',
            'fecha.date' => 'La fecha debe ser una fecha o fecha/hora válida.',

            'total_venta.required' => 'El total de la venta es obligatorio.',
            'total_venta.numeric' => 'El total de la venta debe ser un valor numérico.',
            'total_venta.min' => 'El total de la venta no puede ser negativo.',
            'total_venta.between' => 'El total de la venta está fuera del rango permitido.',

            'ganancia_total.required' => 'La ganancia total es obligatoria.',
            'ganancia_total.numeric' => 'La ganancia total debe ser un valor numérico.',
            'ganancia_total.between' => 'La ganancia total está fuera del rango permitido.',

            'id_usuario.required' => 'El usuario es obligatorio.',
            'id_usuario.integer' => 'El identificador del usuario debe ser un entero.',
            'id_usuario.exists' => 'El usuario seleccionado no existe.',
        ];
    }
}