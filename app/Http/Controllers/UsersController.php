<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    public function admin(Request $request)
    {
        $users = User::all();
        return view('users.admin', compact('users'));
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Verificar si el usuario tiene el nivel 3
        if (auth()->user()->level != 3) {
            return redirect()->route('users.admin');
        }

        $user->delete();
        return redirect()->route('users.admin');
    }
}
