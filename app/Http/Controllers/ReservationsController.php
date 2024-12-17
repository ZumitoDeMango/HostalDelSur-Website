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
use App\Http\Requests\CreateReservationRequest;
use Carbon\Carbon;

class ReservationsController extends Controller
{
    public function form($id)
    {
        $room = Room::findOrFail($id);

        $stays = Stay::where('habitacion', $id)->get();

        $occupiedDates = [];
        foreach ($stays as $stay) {
            $start = Carbon::parse($stay->fecha_inicio);
            $end = Carbon::parse($stay->fecha_fin);

            while ($start <= $end) {
                $occupiedDates[] = $start->format('d-m-Y');
                $start->addDay();
            }
        }

        return view('reservations.form', compact('room', 'occupiedDates'));
    }

    public function store(CreateReservationRequest $request) 
    {
        $validated = $request->validated();

        // extraer y procesar fechas
        [$startDate, $endDate] = explode(' hasta ', $validated['fechas']);
        $start = Carbon::createFromFormat('d-m-Y', $startDate);
        $end = Carbon::createFromFormat('d-m-Y', $endDate);
        $totalNoches = $start->diffInDays($end);

        // obtener la habitacion y calcular precio total
        $room = Room::findOrFail($validated['room_id']);
        $totalPrecio = $totalNoches * $room->precio;

        // crear la reserva
        $reservation = Reservation::create([
            'fecha_reserva' => now(),
            'rut_o_pasaporte' => $validated['rut_o_pasaporte'],
            'nombre' => $validated['nombre'],
            'correo' => $validated['correo'],
            'fono' => $validated['fono'],
            'info_adicional' => $validated['info_adicional'],
            'total_noches' => $totalNoches,
            'total_precio' => $totalPrecio,
        ]);

        // crear la estadia
        Stay::create([
            'reserva' => $reservation->id,
            'habitacion' => $room->id,
            'fecha_inicio' => $start,
            'fecha_fin' => $end,
        ]);

        // crear el pago
        Payment::create([
            'reserva' => $reservation->id,
            'monto' => $validated['monto'],
            'tipo_pago' => $validated['metodo_pago'],
            'estado' => 'sin validar',
            'fecha_pago' => now(),
        ]);

        return redirect()->route('home.index')->with('success', 'Reserva y pago realizados exitosamente.');
    }

    public function admin(Request $request)
    {
        $reservations = Reservation::all();
        $stays = Stay::all();
        return view('reservations.admin', compact('reservations', 'stays'));
    }

    public function show($id)
    {
        $reservation = Reservation::findOrFail($id);
        $stays = Stay::where('reserva', $id)->with('room')->get();
        $payments = Payment::where('reserva', $id)->get();

        return view('reservations.show', [
            'reservation' => $reservation,
            'stays' => $stays,
            'payments' => $payments,
        ]);
    }

    public function destroy($id) 
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();
        return redirect()->route('reservations.admin');
    }
}
