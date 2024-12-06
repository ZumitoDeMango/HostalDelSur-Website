<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Room;
use App\Models\Type;
use App\Models\Reservation;
use App\Models\Stay;
use App\Models\Payment;
use App\Http\Requests\LoginRequest;
use Carbon\Carbon;

class AdminController extends Controller
{
    // mostrar dashboard
    public function dashboard()
    {
        $stays = Stay::with('room', 'reservation')->get();
    
        // Obtener los pagos pagados del mes actual
        $monthlyIncome = Payment::where('estado', 'pagado')
                                ->whereMonth('fecha_pago', Carbon::now()->month)
                                ->whereYear('fecha_pago', Carbon::now()->year)
                                ->sum('monto');
        
        return view('admin.dashboard', compact('stays', 'monthlyIncome'));
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
