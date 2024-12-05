<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\RoomsController;
use App\Http\Controllers\ReservationsController;
use App\Models\Room;
use App\Models\Reservation;

class ReservationsController extends Controller
{
    public function form($id)
    {
        $room = Room::find($id);
        return view('reservations.form', compact('room'));
    }

    public function admin(Request $request)
    {
        $reservations = Reservation::all();
        return view('reservations.admin', compact('reservations'));
    }
}
