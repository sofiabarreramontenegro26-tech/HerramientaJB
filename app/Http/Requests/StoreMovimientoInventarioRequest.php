<?php

namespace App\Http\Requests\MovimientoInventario;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreMovimientoInventarioRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'tipo' => ['required', 'string', Rule::in(['ENTRADA', 'SALIDA'])],
            'cantidad' => ['required', 'integer', 'min:1'],
            'motivo' => ['nullable', 'string', 'max:255'],
            'fecha' => ['required', 'date'],
            'id_producto' => ['required', 'integer', 'exists:productos,id_producto'],
        ];
    }

    public function messages(): array
    {
        return [
            'tipo.required' => 'El tipo de movimiento es obligatorio.',
            'tipo.string' => 'El tipo de movimiento debe ser un texto válido.',
            'tipo.in' => 'El tipo de movimiento debe ser ENTRADA o SALIDA.',

            'cantidad.required' => 'La cantidad es obligatoria.',
            'cantidad.integer' => 'La cantidad debe ser un número entero.',
            'cantidad.min' => 'La cantidad debe ser al menos 1.',

            'motivo.string' => 'El motivo debe ser una cadena de texto.',
            'motivo.max' => 'El motivo no puede superar los 255 caracteres.',

            'fecha.required' => 'La fecha es obligatoria.',
            'fecha.date' => 'La fecha ingresada no tiene un formato válido.',

            'id_producto.required' => 'Debes seleccionar un producto.',
            'id_producto.integer' => 'El identificador del producto debe ser un número entero.',
            'id_producto.exists' => 'El producto seleccionado no existe en la base de datos.',
        ];
    }
}