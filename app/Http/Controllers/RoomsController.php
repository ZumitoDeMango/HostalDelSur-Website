<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Room;
use App\Models\Type;
use App\Models\Stay;
use App\Http\Requests\CreateRoomRequest;
use App\Http\Requests\UpdateRoomRequest;

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

        $search = $request->input('search');

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
                $filePath = $file->storeAs('rooms', $fileName, 'public');
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
        
        if (Stay::where('habitacion', $room->id)->exists()) {
            return redirect()->route('rooms.admin')->with('error', 'No se puede eliminar la habitación porque tiene reservas asociadas.');
        }
    
        $room->delete();
        return redirect()->route('rooms.admin')->with('success', 'Habitación eliminada correctamente.');
    }

    public function edit($id)
    {
        $room = Room::findOrFail($id);
        $types = Type::all();
        return view('rooms.edit', compact('room', 'types'));
    }

    public function update(UpdateRoomRequest $request, $id)
    {
        $validated = $request->validated();
        $room = Room::findOrFail($id);

        $room->nombre = $request->input('nombre');
        $room->tipo = $request->input('tipo');
        $room->precio = $request->input('precio');
        $room->banopriv = $request->has('banopriv');
        $room->television = $request->has('television');
        $room->aireac = $request->has('aireac');
        $room->descripcion = $request->input('descripcion');
        $room->piso = $request->input('piso');
        
        // Eliminar fotos seleccionadas
        if ($request->has('remove_photos')) {
            $photosToRemove = $request->input('remove_photos');
            foreach ($photosToRemove as $photo) {
                $path = storage_path('app/public/' . $photo);
                if (file_exists($path)) {
                    unlink($path); // Eliminar la foto del sistema de archivos
                }
            }
    
            // Filtrar las fotos restantes
            $currentPhotos = json_decode($room->urlfoto, true);
            $remainingPhotos = array_filter($currentPhotos, fn($photo) => !in_array($photo, $photosToRemove));
            $room->urlfoto = json_encode(array_values($remainingPhotos));
        }
    
        // Subir nuevas fotos
        if ($request->hasFile('foto')) {
            $newPhotos = [];
            foreach ($request->file('foto') as $photo) {
                $fileName = time() . '_' . $photo->getClientOriginalName();
                $filePath = $photo->storeAs('rooms', $fileName, 'public');
                $newPhotos[] = $filePath;
            }
            $currentPhotos = json_decode($room->urlfoto, true);
            $room->urlfoto = json_encode(array_merge($currentPhotos, $newPhotos));
        }
    
        $room->save();
        return redirect()->route('rooms.admin');
    }

    public function toggleDisp(Request $request, $id)
    {
        $room = Room::findOrFail($id);

        $room->disponible = !$room->disponible;
        $room->save();

        return redirect()->route('rooms.admin');
    }
}
