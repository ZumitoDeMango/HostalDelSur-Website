<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UsersController extends Controller
{
    public function admin(Request $request)
    {
        $users = User::all();
        return view('users.admin', compact('users'));
    }

    public function store(CreateUserRequest $request)
    {
        User::create([
            'rut' => $request->rut,
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'level' => $request->level,
        ]);

        return redirect()->route('users.admin');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if (auth()->user()->level != 3) {
            return redirect()->route('users.admin');
        }

        $user->delete();
        return redirect()->route('users.admin');
    }

    public function update(UpdateUserRequest $request, $id)
    {
        return redirect()->route('users.admin');
    }
}
