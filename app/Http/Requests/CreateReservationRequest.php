<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateReservationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $roomId = $this->input('room_id');

            // Obtener la habitación con su tipo
            $room = \App\Models\Room::with('type')->find($roomId);

            if ($room && $room->type) {
                // Mapear tipos de habitación a capacidades máximas
                $maxGuestsByType = [
                    'Single' => 1,
                    'Twin' => 2,
                    'Doble' => 2,
                    'Triple' => 3,
                    'Cuadruple' => 4,
                ];

                // Determinar el máximo permitido basado en el tipo
                $maxGuests = $maxGuestsByType[$room->type->nombre] ?? 5; // Por defecto 5 si no está definido

                // Validar el número de huéspedes
                $guests = $this->input('guests');
                if (is_array($guests) && count($guests) > $maxGuests) {
                    $validator->errors()->add('guests', "El número máximo de huéspedes permitidos para una habitación de tipo '{$room->type->nombre}' es $maxGuests.");
                }
            }
        });
    }

    public function rules(): array
    {
        return [
            'rut_o_pasaporte' => 'required|string|max:20',
            'nombre' => 'required|string|max:255',
            'correo' => 'required|email|max:320',
            'fono' => 'required|string|max:15',
            'info_adicional' => 'nullable|string|max:500',
            'fechas' => 'required|string|regex:/^.+ hasta .+$/',
            'room_id' => 'required|exists:rooms,id',

            'monto' => 'required|numeric|min:0',
            'metodo_pago' => 'required|string|in:transferencia,tarjeta,efectivo',

            'guests' => 'required|array',
        ];
    }

    public function messages()
    {
        return [
            'rut_o_pasaporte.required' => 'El campo RUT o Pasaporte es obligatorio.',
            'nombre.required' => 'El nombre completo es obligatorio.',
            'correo.required' => 'El correo electrónico es obligatorio.',
            'correo.email' => 'Por favor, ingrese un correo electrónico válido.',
            'fono.required' => 'El número de teléfono es obligatorio.',
            'fechas.required' => 'Sus fechas de entrada y salida son obligatorias.',
            'fechas.regex' => 'El formato de las fechas seleccionadas es inválido.',
            'room_id.exists' => 'La habitación seleccionada no existe.',
            
            'monto.required' => 'El monto a pagar es obligatorio.',
            'metodo_pago.required' => 'El método de pago es obligatorio.',
            'metodo_pago.in' => 'El método de pago seleccionado no es válido.',

            'guests.required' => 'Tiene que existir al menos un huésped.',
        ];
    }
}
