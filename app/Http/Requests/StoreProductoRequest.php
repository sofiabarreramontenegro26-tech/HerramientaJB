<?php

namespace App\Http\Requests\Producto;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // $table->string('nombre', 100); -> NOT NULL, string, max 100
            'nombre' => ['required', 'string', 'max:100'],

            // $table->text('descripcion')->nullable(); -> Opcional, string
            'descripcion' => ['nullable', 'string'],

            // $table->string('marca', 100)->nullable(); -> Opcional, string, max 100
            'marca' => ['nullable', 'string', 'max:100'],

            // $table->string('imagen', 255)->nullable(); -> Opcional, string o archivo de imagen
            'imagen' => ['nullable', 'string', 'max:255'],

            // $table->integer('cantidad')->default(0); -> NOT NULL, entero, mínimo 0
            'cantidad' => ['sometimes', 'integer', 'min:0'],

            // $table->integer('stock_minimo')->default(5); -> NOT NULL, entero, mínimo 0
            'stock_minimo' => ['sometimes', 'integer', 'min:0'],

            // $table->decimal('precio_compra', 10, 2); -> NOT NULL, numérico, mínimo 0
            'precio_compra' => ['required', 'numeric', 'min:0'],

            // $table->decimal('precio_venta', 10, 2); -> NOT NULL, numérico, mínimo 0
            'precio_venta' => ['required', 'numeric', 'min:0'],

            // $table->foreignId('id_categoria')->constrained('categorias', 'id_categoria'); -> NOT NULL, entero, existe en categorias
            'id_categoria' => ['required', 'integer', 'exists:categorias,id_categoria'],

            // $table->foreignId('id_proveedor')->nullable()->constrained('proveedores', 'id_proveedor'); -> NULLABLE, entero, existe en proveedores
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