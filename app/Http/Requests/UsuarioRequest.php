<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UsuarioRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $usuario = $this->route('usuario');
        $esCreacion = $usuario === null;

        return [
            'nombre_completo' => ['required', 'string', 'max:100'],
            'correo' => [
                'required',
                'email',
                'max:100',
                Rule::unique('usuarios', 'correo')->ignore($usuario?->id_usuario, 'id_usuario'),
            ],
            'id_rol' => ['required', 'integer', 'exists:roles,id_rol,deleted_at,NULL'],
            'password' => [
                $esCreacion ? 'required' : 'nullable',
                'confirmed',
                Password::min(8)->letters()->numbers(),
            ],
        ];
    }

    public function attributes(): array
    {
        return [
            'nombre_completo' => 'nombre completo',
            'id_rol' => 'rol',
            'password' => 'contraseña',
        ];
    }
}
