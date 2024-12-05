<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateReservationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'rut_o_pasaporte' => 'required|string|max:20',
            'nombre' => 'required|string|max:255',
            'correo' => 'required|email|max:320',
            'fono' => 'required|string|max:15',
            'info_adicional' => 'nullable|string|max:500',
            'fechas' => 'required|string|regex:/^.+ hasta .+$/', // Validar rango de fechas
            'room_id' => 'required|exists:rooms,id',
        ];
    }

    public function messages()
    {
        return [
            'rut_o_pasaporte.required' => 'El campo RUT o Pasaporte es obligatorio.',
            'nombre.required' => 'El nombre completo es obligatorio.',
            'correo.required' => 'El correo electrónico es obligatorio.',
            'fono.required' => 'El número de teléfono es obligatorio.',
            'fechas.required' => 'Sus fechas de entrada y salida son obligatorias.',
            'fechas.regex' => 'El formato de las fechas seleccionadas es inválido.',
            'room_id.exists' => 'La habitación seleccionada no existe.',
        ];
    }
}
