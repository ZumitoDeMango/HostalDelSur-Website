<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePaymentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'reserva' => 'required|exists:reservations,id',
            'monto' => 'required|numeric|min:0',
            'metodo_pago' => 'required|string|in:transferencia,tarjeta,paypal',
        ];
    }

    public function messages()
    {
        return [
            'reserva.required' => 'El ID de la reserva es obligatorio.',
            'reserva.exists' => 'La reserva no existe.',
            'monto.required' => 'El monto a pagar es obligatorio.',
            'metodo_pago.in' => 'El método de pago seleccionado no es válido.',
        ];
    }
}
