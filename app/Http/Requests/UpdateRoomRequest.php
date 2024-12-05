<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRoomRequest extends FormRequest
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
            'descripcion' => 'required|string|max:1000',
            'piso' => 'required|integer|min:1',
            'foto' => 'nullable|array',
            'foto.*' => 'image|mimes:jpeg,png,jpg|max:2048',
            'remove_photos' => 'nullable|array',
            'remove_photos.*' => 'string',
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'Por favor, ingresa el nombre de la habitación.',
            'tipo.exists' => 'Selecciona un tipo de habitación válido.',
            'precio.required' => 'El campo de precio es obligatorio.',
            'precio.numeric' => 'El precio debe ser un valor numérico válido.',
            'descripcion.required' => 'La descripción de la habitación es obligatoria.',
            'piso.required' => 'Indica en qué piso se encuentra la habitación.',
            'foto.array' => 'Las fotos deben enviarse como un conjunto de archivos.',
            'foto.*.mimes' => 'Cada foto debe estar en formato JPEG, PNG o JPG.',
            'foto.*.max' => 'Cada foto no puede exceder los 2 MB de tamaño.',
        ];
    }
}
