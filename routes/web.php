<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;

// rutas home
Route::match(['get'], '/', [HomeController::class, 'index'])->name('home.index');

// rutas admin
Route::get('/login', [AdminController::class, 'showLogin'])->name('admin.login');
Route::post('/login', [AdminController::class, 'login'])->name('admin.login.post');
Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');
Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware('auth')->name('admin.dashboard');