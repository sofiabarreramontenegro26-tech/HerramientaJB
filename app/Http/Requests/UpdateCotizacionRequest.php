<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCotizacionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // Obtenemos el ID de la cotización desde la ruta (URL)
        $cotizacionId = $this->route('cotizacion') ?? $this->route('id_cotizacion') ?? $this->route('id');

        return [
            // $table->string('cliente_telefono', 255)->nullable(); -> Opcional, string, max 255
            'cliente_telefono' => ['nullable', 'string', 'max:255'],

            // $table->json('productos_seleccionados'); -> Opcional en update, array/json válido
            'productos_seleccionados' => ['sometimes', 'required', 'array'],

            // $table->decimal('total', 10, 2); -> Opcional en update, numérico, mínimo 0, entre 0 y 99999999.99
            'total' => ['sometimes', 'required', 'numeric', 'min:0', 'between:0,99999999.99'],
        ];
    }

    public function messages(): array
    {
        return [
            'cliente_telefono.string' => 'El teléfono del cliente debe ser un texto válido.',
            'cliente_telefono.max'    => 'El teléfono del cliente no puede superar los 255 caracteres.',

            'productos_seleccionados.required' => 'La lista de productos seleccionados no puede estar vacía.',
            'productos_seleccionados.array'    => 'Los productos seleccionados deben estructurarse en una lista o arreglo válido.',

            'total.required' => 'El total de la cotización no puede estar vacío.',
            'total.numeric'  => 'El total debe ser un valor numérico.',
            'total.min'      => 'El total no puede ser negativo.',
            'total.between'  => 'El total está fuera del rango permitido.',
        ];
    }
}