<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Room;

class AdminController extends Controller
{
    // mostrar dashboard
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    // mostrar habitaciones
    public function rooms(Request $request)
    {
        if ($request->isMethod('get')) {
            // muestra habitaciones
            $rooms = Room::all();
            return view('admin.rooms', compact('rooms'));
        }
        if ($request->isMethod('post')) {
            // guarda la habitacion
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
            return redirect()->route('admin.rooms');
        }
        if ($request->isMethod('delete')) {
            
        }
    }

    // login
    public function login(Request $request)
    {
        if ($request->isMethod('get')) {
            // muestra login
            return view('admin.login');
        }
        if ($request->isMethod('post')) {
            // validar datos
            $request->validate([
                'email' => 'required|email',
                'password' => 'required|min:8',
            ]);
    
            // inicia sesion
            if (Auth::attempt($request->only('email', 'password'))) {
                // redirige al dashboard luego del login
                return redirect()->route('admin.dashboard');
            }
    
            // Si falla, redirigir de nuevo al login con un mensaje de error
            return back()->withErrors([
                'email' => 'Las credenciales no coinciden con nuestros registros.',
            ]);
        }
    }

    // logout
    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }
}
