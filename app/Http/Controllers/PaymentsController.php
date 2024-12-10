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
        $allPayments = Payment::orderBy('fecha_pago')->get();
        $months = $allPayments->pluck('fecha_pago')->unique()
                    ->mapWithKeys(fn($date) => [Carbon::parse($date)->month => Carbon::parse($date)->locale('es')->monthName]);
        $years = $allPayments->pluck('fecha_pago')->map(fn($date) => Carbon::parse($date)->year)->unique();

        $query = Payment::query();
        if ($request->filled('mes')) {
            $query->whereMonth('fecha_pago', $request->mes);
        }
        if ($request->filled('anio')) {
            $query->whereYear('fecha_pago', $request->anio);
        }
        $payments = $query->with('reservation')->get();

        $filteredTotal = $payments->sum('monto');

        return view('payments.admin', compact('payments', 'months', 'years', 'filteredTotal'));
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

    public function toggleStat($id)
    {
        $payment = Payment::findOrFail($id);
        // Cambiar el estado
        $payment->estado = $payment->estado == 'pagado' ? 'pendiente' : 'pagado';
        $payment->save();

        return redirect()->route('payments.admin');
    }

}
