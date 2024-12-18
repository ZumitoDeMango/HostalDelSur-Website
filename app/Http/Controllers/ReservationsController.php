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
use App\Models\Guest;
use App\Models\Payment;
use App\Http\Requests\CreateReservationRequest;
use Carbon\Carbon;

class ReservationsController extends Controller
{
    public function form($id)
    {
        $room = Room::findOrFail($id);

        $stays = Stay::where('habitacion', $id)->get();

        // fechas ocupadas
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

        // crear huespedes
        foreach ($validated['guests'] as $guestData) {
            $guest = Guest::create([
                'reserva' => $reservation->id,
                'rut_o_pasaporte' => $guestData['rut_o_pasaporte'],
                'nombre' => $guestData['nombre'],
                'correo' => $guestData['correo'],
                'fono' => $guestData['fono'],
            ]);
        }

        return redirect()->route('home.index');
    }

    public function admin(Request $request)
    {
        // Obtener las fechas actuales de mes y año
        $currentMonth = now()->month;
        $currentYear = now()->year;

        // Obtener los valores de mes y año seleccionados en el request, o los valores actuales por defecto
        $selectedMonth = $request->input('mes', $currentMonth);
        $selectedYear = $request->input('anio', $currentYear);

        // Crear la consulta base de las reservas
        $query = Reservation::query();

        // Filtrar por mes si se ha seleccionado
        if ($selectedMonth) {
            $query->whereMonth('fecha_reserva', $selectedMonth);
        }

        // Filtrar por año si se ha seleccionado
        if ($selectedYear) {
            $query->whereYear('fecha_reserva', $selectedYear);
        }

        // Obtener las reservas filtradas
        $reservations = $query->get();

        // Obtener las estancias relacionadas
        $stays = Stay::all();

        // Opcionalmente, si quieres pasar los meses y años disponibles para el filtrado (como en los pagos):
        $months = Reservation::pluck('fecha_reserva')->unique()
            ->mapWithKeys(fn($date) => [Carbon::parse($date)->month => Carbon::parse($date)->locale('es')->monthName]);
        $years = Reservation::pluck('fecha_reserva')->map(fn($date) => Carbon::parse($date)->year)->unique();

        return view('reservations.admin', compact('reservations', 'stays', 'months', 'years', 'selectedMonth', 'selectedYear'));
    }

    public function show($id)
    {
        $reservation = Reservation::findOrFail($id);
        $stays = Stay::where('reserva', $id)->with('room')->get();
        $payments = Payment::where('reserva', $id)->get();
        $guests = Guest::where('reserva', $id)->get();

        return view('reservations.show', [
            'reservation' => $reservation,
            'stays' => $stays,
            'payments' => $payments,
            'guests' => $guests,
        ]);
    }

    public function destroy($id) 
    {
        // Buscar la reserva por su ID
        $reservation = Reservation::findOrFail($id);

        // Eliminar todos los huéspedes relacionados (guests)
        $reservation->guests()->delete();

        // Eliminar todas las estadías relacionadas (stays)
        $reservation->stays()->delete();

        // Eliminar todos los pagos relacionados (payments)
        $reservation->payments()->delete();

        // Eliminar la reserva en sí
        $reservation->delete();

        // Redirigir al administrador de reservas con un mensaje de éxito
        return redirect()->route('reservations.admin');
    }
}
