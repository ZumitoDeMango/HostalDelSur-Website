<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;

// Rutas Home
Route::prefix('/')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home.index');
    Route::get('/sobre-nosotros', [HomeController::class, 'about'])->name('home.about');
    Route::get('/habitaciones', [HomeController::class, 'rooms'])->name('home.rooms');
    Route::get('/ubicacion', [HomeController::class, 'location'])->name('home.location');
    Route::get('/contacto', [HomeController::class, 'contact'])->name('home.contact');
});

// Rutas Login Admin
Route::prefix('/admin')->group(function () {
    Route::match(['get', 'post'], '/login', [AdminController::class, 'login'])->name('admin.login');
    Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');
});

// Rutas Dashboard Admin (con middleware de autenticación)
Route::prefix('/dashboard')->middleware('auth')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Rutas para gestionar habitaciones
    Route::match(['get', 'post'], '/habitaciones', [AdminController::class, 'rooms'])->name('admin.rooms');
    Route::delete('/habitaciones/{room}', [AdminController::class, 'destroyRoom'])->name('admin.room.destroy');

    // Rutas para reservas, administradores y pagos
    Route::get('/reservas', [AdminController::class, 'booking'])->name('admin.booking');
    Route::get('/administradores', [AdminController::class, 'admins'])->name('admin.admins');
    Route::get('/pagos', [AdminController::class, 'payments'])->name('admin.payments');
});