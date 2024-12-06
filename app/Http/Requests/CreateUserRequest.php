<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'rut' => 'required|string|unique:users,rut|max:12',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:320',
            'password' => 'required|string|min:8',
            'level' => 'required|integer|in:1,2,3',
        ];
    }

    public function messages()
    {
        return [
            'rut.required' => 'El RUT es obligatorio.',
            'rut.unique' => 'El RUT ya está registrado.',
            'name.required' => 'El nombre es obligatorio.',
            'email.required' => 'El correo es obligatorio.',
            'email.unique' => 'El correo ya está registrado.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'level.required' => 'El nivel es obligatorio.',
            'level.in' => 'El nivel debe ser 1, 2 o 3.',
        ];
    }
}
