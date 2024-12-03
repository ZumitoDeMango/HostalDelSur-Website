<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateRoomRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre' => 'required|string|max:255',
            'tipo' => 'required|exists:types,id',
            'precio' => 'required|numeric|min:0',
            'banopriv' => 'nullable|boolean',
            'television' => 'nullable|boolean',
            'aireac' => 'nullable|boolean',
            'descripcion' => 'nullable|string|max:1000',
            'piso' => 'required|integer|min:1',
            'foto' => 'nullable|image|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'El nombre de la habitación es obligatorio.',
            'tipo.exists' => 'Debe seleccionar un tipo de habitación.',
            'precio.required' => 'El precio es obligatorio.',
            'precio.numeric' => 'El precio debe ser un número válido.',
            'piso.required' => 'El piso es obligatorio.',
            'foto.image' => 'La foto debe ser una imagen válida.',
            'foto.max' => 'La foto no debe superar los 2 MB.',
        ];
    }
}
