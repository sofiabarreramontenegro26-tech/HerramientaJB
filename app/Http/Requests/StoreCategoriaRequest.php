<?php

namespace App\Http\Requests\Categoria;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoriaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // $table->string('nombre', 100); -> NOT NULL, string, max 100
            'nombre' => ['required', 'string', 'max:100', 'unique:categorias,nombre'],

            // $table->text('descripcion')->nullable(); -> Opcional, texto
            'descripcion' => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre de la categoría es obligatorio.',
            'nombre.string' => 'El nombre debe ser un texto válido.',
            'nombre.max' => 'El nombre no puede superar los 100 caracteres.',
            'nombre.unique' => 'Ya existe una categoría con este nombre.',

            'descripcion.string' => 'La descripción debe ser un texto válido.',
        ];
    }
}