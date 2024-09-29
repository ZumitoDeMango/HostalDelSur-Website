<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    // mostrar home
    public function index(){
        return view('home.index');
    }
}
