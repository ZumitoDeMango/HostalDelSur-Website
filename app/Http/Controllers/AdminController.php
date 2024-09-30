<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Room;

class AdminController extends Controller
{
    // mostrar login
    public function showLogin()
    {
        return view('admin.login');
    }

    // mostrar dashboard
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    // mostrar habitaciones
    public function rooms(Request $request)
    {
        if ($request->isMethod('get')) {
            $rooms = Room::all();
            return view('admin.rooms', compact('rooms'));
        }
        if ($request->isMethod('post')) {
            
        }
    }

    // procesa el login
    public function login(Request $request)
    {
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

    // logout
    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }
}
