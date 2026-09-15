<?php

namespace App\Http\Requests\Producto;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre' => ['sometimes', 'required', 'string', 'max:100'],
            'descripcion' => ['nullable', 'string'],
            'marca' => ['nullable', 'string', 'max:100'],
            'imagen' => ['nullable', 'string', 'max:255'],
            'cantidad' => ['sometimes', 'integer', 'min:0'],
            'stock_minimo' => ['sometimes', 'integer', 'min:0'],
            'precio_compra' => ['sometimes', 'required', 'numeric', 'min:0'],
            'precio_venta' => ['sometimes', 'required', 'numeric', 'min:0'],
            'id_categoria' => ['sometimes', 'required', 'integer', 'exists:categorias,id_categoria'],
            'id_proveedor' => ['nullable', 'integer', 'exists:proveedores,id_proveedor'],
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre del producto es obligatorio.',
            'nombre.string' => 'El nombre debe ser un texto válido.',
            'nombre.max' => 'El nombre no puede superar los 100 caracteres.',

            'descripcion.string' => 'La descripción debe ser un texto válido.',

            'marca.string' => 'La marca debe ser un texto válido.',
            'marca.max' => 'La marca no puede superar los 100 caracteres.',

            'imagen.string' => 'La ruta o URL de la imagen debe ser un texto válido.',
            'imagen.max' => 'La ruta de la imagen no puede superar los 255 caracteres.',

            'cantidad.integer' => 'La cantidad debe ser un número entero.',
            'cantidad.min' => 'La cantidad no puede ser negativa.',

            'stock_minimo.integer' => 'El stock mínimo debe ser un número entero.',
            'stock_minimo.min' => 'El stock mínimo no puede ser negativo.',

            'precio_compra.required' => 'El precio de compra es obligatorio.',
            'precio_compra.numeric' => 'El precio de compra debe ser un valor numérico.',
            'precio_compra.min' => 'El precio de compra no puede ser negativo.',

            'precio_venta.required' => 'El precio de venta es obligatorio.',
            'precio_venta.numeric' => 'El precio de venta debe ser un valor numérico.',
            'precio_venta.min' => 'El precio de venta no puede ser negativo.',

            'id_categoria.required' => 'La categoría es obligatoria.',
            'id_categoria.integer' => 'El identificador de la categoría debe ser un entero.',
            'id_categoria.exists' => 'La categoría seleccionada no existe.',

            'id_proveedor.integer' => 'El identificador del proveedor debe ser un entero.',
            'id_proveedor.exists' => 'El proveedor seleccionado no existe.',
        ];
    }
}