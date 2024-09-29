<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    // mostrar home
    public function index(){
        return view('home.index');
    }
    public function about(){
        return view('home.about');
    }
    public function rooms(){
        return view('home.rooms');
    }
    public function location(){
        return view('home.location');
    }
    public function contact(){
        return view('home.contact');
    }
}
