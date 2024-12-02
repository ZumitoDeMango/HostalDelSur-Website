<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Room;
use App\Models\Type;

class RoomsController extends Controller
{
    public function index(Request $request)
    {
        $rooms = Room::with('type')->get();
        $types = Type::all();
        $tipoSelec = $request->input('tipo');

        $rooms = Room::with('type')
        ->when($tipoSelec, function ($query) use ($tipoSelec) {
            $query->whereHas('type', function ($query) use ($tipoSelec) {
                $query->where('nombre', $tipoSelec);
            });
        })
        ->get();
        
        return view('rooms.index', compact('rooms', 'types', 'tipoSelec'));
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
