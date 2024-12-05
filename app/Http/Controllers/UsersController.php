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
}
