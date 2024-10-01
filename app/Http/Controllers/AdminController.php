<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    // mostrar dashboard
    public function dashboard()
    {
        return view('admin.dashboard');
    }
    
    // login y logout
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
    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }
}
