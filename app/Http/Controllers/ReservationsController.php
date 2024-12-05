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
use App\Http\Requests\CreateReservationRequest;
use Carbon\Carbon;

class ReservationsController extends Controller
{
    public function form($id)
    {
        $types = Type::all();
        $room = Room::find($id);
        return view('reservations.form', compact('room'));
    }

    public function store(CreateReservationRequest $request) 
    {
        $validated = $request->validated();

        [$startDate, $endDate] = explode(' hasta ', $validated['fechas']);
        $start = Carbon::createFromFormat('d-m-Y', $startDate);
        $end = Carbon::createFromFormat('d-m-Y', $endDate);

        $totalNoches = $start->diffInDays($end);

        $room = Room::findOrFail($validated['room_id']);

        $totalPrecio = $totalNoches * $room->precio;

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

        Stay::create([
            'reserva' => $reservation->id,
            'habitacion' => $room->id,
            'fecha_inicio' => $start,
            'fecha_fin' => $end,
        ]);

        return redirect()->route('payments.form', ['id' => $reservation->id]);
    }

    public function admin(Request $request)
    {
        $reservations = Reservation::all();
        return view('reservations.admin', compact('reservations'));
    }
}
