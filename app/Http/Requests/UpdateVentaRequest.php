<?php

namespace App\Http\Requests\Venta;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVentaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // Obtenemos el ID de la venta desde la ruta (URL)
        $ventaId = $this->route('venta') ?? $this->route('id_venta');

        return [
            // $table->string('cliente', 255); -> Opcional en update, pero si se envía no debe ser nulo
            'cliente' => ['sometimes', 'required', 'string', 'max:255'],

            // $table->dateTime('fecha'); -> Opcional en update, fecha/hora válida
            'fecha' => ['sometimes', 'required', 'date'],

            // $table->decimal('total_venta', 10, 2); -> Opcional en update, numérico min 0
            'total_venta' => ['sometimes', 'required', 'numeric', 'min:0', 'between:0,99999999.99'],

            // $table->decimal('ganancia_total', 10, 2); -> Opcional en update, numérico
            'ganancia_total' => ['sometimes', 'required', 'numeric', 'between:-99999999.99,99999999.99'],

            // $table->foreignId('id_usuario')->constrained('usuarios', 'id_usuario'); -> Opcional en update, entero existente
            'id_usuario' => ['sometimes', 'required', 'integer', 'exists:usuarios,id_usuario'],
        ];
    }

    public function messages(): array
    {
        return [
            'cliente.required' => 'El nombre del cliente no puede estar vacío.',
            'cliente.string'   => 'El nombre del cliente debe ser un texto válido.',
            'cliente.max'      => 'El nombre del cliente no puede superar los 255 caracteres.',

            'fecha.required' => 'La fecha de la venta no puede estar vacía.',
            'fecha.date'     => 'La fecha debe ser una fecha o fecha/hora válida.',

            'total_venta.required' => 'El total de la venta no puede estar vacío.',
            'total_venta.numeric'  => 'El total de la venta debe ser un valor numérico.',
            'total_venta.min'      => 'El total de la venta no puede ser negativo.',
            'total_venta.between'  => 'El total de la venta está fuera del rango permitido.',

            'ganancia_total.required' => 'La ganancia total no puede estar vacía.',
            'ganancia_total.numeric'  => 'La ganancia total debe ser un valor numérico.',
            'ganancia_total.between'  => 'La ganancia total está fuera del rango permitido.',

            'id_usuario.required' => 'El usuario no puede estar vacío.',
            'id_usuario.integer'  => 'El identificador del usuario debe ser un entero.',
            'id_usuario.exists'   => 'El usuario seleccionado no existe.',
        ];
    }
}