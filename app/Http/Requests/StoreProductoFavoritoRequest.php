<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductoFavoritoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // $table->foreignId('id_usuario')->nullable()->constrained('usuarios', 'id_usuario'); -> NULLABLE, entero, existe en usuarios
            'id_usuario' => ['nullable', 'integer', 'exists:usuarios,id_usuario'],

            // $table->foreignId('id_producto')->constrained('productos', 'id_producto'); -> NOT NULL, entero, existe en productos
            'id_producto' => ['required', 'integer', 'exists:productos,id_producto'],
        ];
    }

    public function messages(): array
    {
        return [
            'id_usuario.integer' => 'El identificador del usuario debe ser un entero.',
            'id_usuario.exists'  => 'El usuario seleccionado no existe.',

            'id_producto.required' => 'El producto es obligatorio.',
            'id_producto.integer'  => 'El identificador del producto debe ser un entero.',
            'id_producto.exists'   => 'El producto seleccionado no existe.',
        ];
    }
}