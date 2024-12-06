<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\RoomsController;
use App\Http\Controllers\ReservationsController;
use App\Http\Controllers\TypesController;
use App\Models\Room;
use App\Models\Type;
use App\Models\Reservation;
use App\Models\Stay;
use App\Models\Payment;
use App\Http\Requests\CreatePaymentRequest;
use Carbon\Carbon;

class PaymentsController extends Controller
{
    public function admin(Request $request)
    {
        $payments = Payment::all();
        return view('payments.admin', compact('payments'));
    }

    public function form($id)
    {
        $reservation = Reservation::find($id);
        return view('payments.form', compact('reservation'));
    }

    public function process(CreatePaymentRequest $request)
    {
        $validated = $request->validated();

        $reserva = Reservation::findOrFail($validated['reserva']);

        Payment::create([
            'reserva' => $reserva->id,
            'monto' => $validated['monto'],
            'tipo_pago' => $validated['metodo_pago'],
            'estado' => 'sin validar',
            'fecha_pago' => now(),
        ]);

        return redirect()->route('home.index');
    }
}
