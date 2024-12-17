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

        $currentMonth = now()->month;
        $currentYear = now()->year;
        $selectedMonth = $request->input('mes', $currentMonth);
        $selectedYear = $request->input('anio', $currentYear);

        $query = Payment::query();
        if ($selectedMonth) {
            $query->whereMonth('fecha_pago', $selectedMonth);
        }
        if ($selectedYear) {
            $query->whereYear('fecha_pago', $selectedYear);
        }

        $payments = $query->with('reservation')->get();

        $filteredTotal = $payments->where('estado', 'pagado')->sum('monto');

        return view('payments.admin', compact('payments', 'months', 'years', 'filteredTotal', 'selectedMonth', 'selectedYear'));
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
