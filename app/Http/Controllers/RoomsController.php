<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Room;

class RoomsController extends Controller
{
    public function index()
    {
        return view('rooms.index');
    }
    public function admin() 
    {
        $rooms = Room::all();
        return view('rooms.admin', compact('rooms'));
    }
    public function store(Request $request) 
    {
        $room = new Room();
        $room->nombre = $request->nombre;
        $room->tipo = $request->tipo;
        $room->precio = $request->precio;
        $room->banopriv = $request->has('banopriv') ? 1 : 0;
        $room->television = $request->has('television') ? 1 : 0;
        $room->aireac = $request->has('aireac') ? 1 : 0;
        $room->descripcion = $request->descripcion;
        $room->piso = $request->piso;
        $room->disponible = 1;
        $room->save();
        return redirect()->route('rooms.admin');
    }
    public function destroy($id) 
    {
        $room = Room::findOrFail($id);
        $room->delete();
        return redirect()->route('rooms.admin');
    }
}
