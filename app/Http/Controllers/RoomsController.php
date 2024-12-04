<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Room;
use App\Models\Type;
use App\Http\Requests\CreateRoomRequest;

class RoomsController extends Controller
{
    public function index(Request $request)
    {
        $types = Type::all();

        $tipoSelec = $request->input('tipo');

        $rooms = Room::with('type')
            ->where('disponible', true)
            ->when($tipoSelec, function ($query) use ($tipoSelec) {
                $query->whereHas('type', function ($query) use ($tipoSelec) {
                    $query->where('nombre', $tipoSelec);
                });
            })
            ->get();

        return view('rooms.index', compact('rooms', 'types', 'tipoSelec'));
    }

    public function admin(Request $request) 
    {
        $rooms = Room::all();
        $types = Type::all();

        // Obtener el término de búsqueda desde la solicitud
        $search = $request->input('search');

        // Obtener habitaciones filtradas o todas si no hay búsqueda
        $rooms = Room::with('type')
            ->when($search, function ($query, $search) {
                $query->where('nombre', 'LIKE', '%' . $search . '%');
            })
            ->get();

        return view('rooms.admin', compact('rooms', 'types'));
    }

    public function store(CreateRoomRequest $request)
    {
        $room = $request->validated();
        
        $filePaths = [];
        if ($request->hasFile('foto')) {
            foreach ($request->file('foto') as $file) {
                $fileName = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('images', $fileName, 'public');
                $filePaths[] = $filePath;
            }
        }
        
        $room['banopriv'] = $request->has('banopriv') ? 1 : 0;
        $room['television'] = $request->has('television') ? 1 : 0;
        $room['aireac'] = $request->has('aireac') ? 1 : 0;
        $room['disponible'] = 1;
        $room['urlfoto'] = json_encode($filePaths);

        Room::create($room);

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
        $types = Type::all();
        return view('rooms.edit', compact('room', 'types'));
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
        $room->urlfoto = 'foto.jpg';
        $room->save();
        return redirect()->route('rooms.admin');
    }
    public function toggleDisp(Request $request, $id)
    {
        // Encuentra la habitación
        $room = Room::findOrFail($id);

        // Cambia el estado de disponibilidad
        $room->disponible = !$room->disponible;
        $room->save();

        // Redirige de vuelta con un mensaje de éxito
        return redirect()->route('rooms.admin');
    }

}
