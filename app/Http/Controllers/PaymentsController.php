<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentsController extends Controller
{
    public function form()
    {
        return view('payments.form');
    }

    public function process(CreatePaymentRequest $request)
    {
        $validated = $request->validated();

        $reserva = Reservation::findOrFail($validated['reserva']);

        Payment::create([
            'reserva' => $reserva->id,
            'monto' => $validated['monto'],
            'tipo_pago' => $validated['metodo_pago'],
            'estado' => 'completado',
            'fecha_pago' => now(),
        ]);

        $reserva->stays->each(function ($stay) {
            $stay->room->update(['disponible' => false]);
        });

        return redirect()->route('home.index');
    }
}
