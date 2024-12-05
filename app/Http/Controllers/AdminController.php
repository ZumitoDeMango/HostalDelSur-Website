<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;

class AdminController extends Controller
{
    // mostrar dashboard
    public function dashboard()
    {
        return view('admin.dashboard');
    }
    
    // login y logout
    public function showLogin()
    {
        return view('admin.login');
    }

    public function login(LoginRequest $request)
    {
        // Intentar autenticar con el email y password proporcionados
        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate(); // Prevenir ataques de fijación de sesión
            return redirect()->route('admin.dashboard')->with('success', 'Sesión iniciada correctamente.');
        }

        // Si la autenticación falla, redirigir con mensaje de error
        return back()->withErrors([
            'email' => 'Credenciales incorrectas. Por favor, inténtalo de nuevo.',
        ])->withInput($request->except('password')); // Retener todos los datos excepto la contraseña
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
