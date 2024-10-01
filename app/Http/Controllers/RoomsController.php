<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Room;

class RoomsController extends Controller
{
    public function index(Request $request)
    {
        $tipo = $request->get('tipo');
        $rooms = Room::when($tipo, function ($query, $tipo) {
            return $query->where('tipo', $tipo);
        })->get();

        /* $rooms = Room::all(); */
        return view('rooms.index', compact('rooms'));
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
    public function edit($id)
    {
        $room = Room::findOrFail($id);
        return view('rooms.edit', compact('room'));
    }
    public function update(Request $request, $id)
    {
        $room = Room::findOrFail($id); 
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
}
