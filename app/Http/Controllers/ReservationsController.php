<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\RoomsController;
use App\Models\Room;

class ReservationsController extends Controller
{
    public function form($id)
    {
        $room = Room::find($id);
        return view('reservations.form', compact('room'));
    }
}
