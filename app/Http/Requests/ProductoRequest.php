<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $reglas = [
            'nombre' => ['required', 'string', 'max:100'],
            'descripcion' => ['nullable', 'string', 'max:2000'],
            'marca' => ['nullable', 'string', 'max:100'],
            'imagen' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'stock_minimo' => ['required', 'integer', 'min:0', 'max:100000'],
            'precio_compra' => ['required', 'numeric', 'min:0', 'max:99999999.99'],
            'precio_venta' => ['required', 'numeric', 'min:0', 'max:99999999.99', 'gte:precio_compra'],
            'id_categoria' => ['required', 'integer', 'exists:categorias,id_categoria,deleted_at,NULL'],
            'id_proveedor' => ['nullable', 'integer', 'exists:proveedores,id_proveedor,deleted_at,NULL'],
        ];

        // La cantidad solo se define al crear. Después, el stock cambia únicamente
        // con entradas y salidas para no perder la trazabilidad.
        if ($this->isMethod('post')) {
            $reglas['cantidad'] = ['required', 'integer', 'min:0', 'max:100000'];
        }

        return $reglas;
    }

    public function attributes(): array
    {
        return [
            'id_categoria' => 'categoría',
            'id_proveedor' => 'proveedor',
            'stock_minimo' => 'stock mínimo',
            'precio_compra' => 'precio de compra',
            'precio_venta' => 'precio de venta',
            'cantidad' => 'cantidad inicial',
        ];
    }

    public function messages(): array
    {
        return [
            'precio_venta.gte' => 'El precio de venta no puede ser menor que el precio de compra.',
        ];
    }
}
