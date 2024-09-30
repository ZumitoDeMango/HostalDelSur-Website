<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;

// rutas home
Route::match(['get'], '/', [HomeController::class, 'index'])->name('home.index');
Route::match(['get'], '/sobre-nosotros', [HomeController::class, 'about'])->name('home.about');
Route::match(['get'], '/habitaciones', [HomeController::class, 'rooms'])->name('home.rooms');
Route::match(['get'], '/ubicacion', [HomeController::class, 'location'])->name('home.location');
Route::match(['get'], '/contacto', [HomeController::class, 'contact'])->name('home.contact');

// rutas login admin
Route::get('/login', [AdminController::class, 'showLogin'])->name('admin.login');
Route::post('/login', [AdminController::class, 'login'])->name('admin.login.post');
Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');

// rutas dashboard admin
Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard')->middleware('auth');
Route::match(['get', 'post'], '/dashboard-habitaciones', [AdminController::class, 'rooms'])->name('admin.rooms')->middleware('auth');
Route::get('/dashboard-reservas', [AdminController::class, 'booking'])->name('admin.booking')->middleware('auth');
Route::get('/dashboard-administradores', [AdminController::class, 'admins'])->name('admin.admins')->middleware('auth');
Route::get('/dashboard-pagos', [AdminController::class, 'payments'])->name('admin.payments')->middleware('auth');