<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRegistroConectividadRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'estado_conexion' => 'sometimes|boolean',
            'fecha_registro'  => 'sometimes|date',
        ];
    }
}