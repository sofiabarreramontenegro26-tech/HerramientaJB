<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoriaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $categoria = $this->route('categoria');

        return [
            'nombre' => [
                'required',
                'string',
                'max:100',
                Rule::unique('categorias', 'nombre')
                    ->ignore($categoria?->id_categoria, 'id_categoria')
                    ->whereNull('deleted_at'),
            ],
            'descripcion' => ['nullable', 'string', 'max:1000'],
        ];
    }
}
