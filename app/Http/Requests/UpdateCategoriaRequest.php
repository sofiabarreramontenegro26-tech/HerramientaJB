<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCategoriaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // Obtiene el ID de la categoría enviada por la ruta
        $categoriaId = $this->route('categoria') ?? $this->route('id_categoria');

        return [
            'nombre' => [
                'sometimes',
                'string',
                'max:100',
                // Ignora el registro actual evaluando sobre la llave primaria 'id_categoria'
                Rule::unique('categorias', 'nombre')->ignore($categoriaId, 'id_categoria'),
            ],
            'descripcion' => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.string' => 'El nombre debe ser un texto válido.',
            'nombre.max' => 'El nombre no puede superar los 100 caracteres.',
            'nombre.unique' => 'Ya existe otra categoría con este nombre.',

            'descripcion.string' => 'La descripción debe ser un texto válido.',
        ];
    }
}