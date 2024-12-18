<?php
/* Route::get('', [Controller::class, ''])->name(''); */
/* @dd($rooms); */

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RoomsController;
use App\Http\Controllers\ReservationsController;
use App\Http\Controllers\PaymentsController;
use App\Http\Controllers\UsersController;

// Rutas Home
Route::prefix('/')->group(function () {
    // Rutas del navbar
    Route::get('/', [HomeController::class, 'index'])->name('home.index');
    Route::get('/sobre-nosotros', [HomeController::class, 'about'])->name('home.about');
    Route::get('/habitaciones', [RoomsController::class, 'index'])->name('rooms.index');
    Route::post('/habitaciones', [RoomsController::class, 'index'])->name('rooms.index');
    Route::get('/ubicacion', [HomeController::class, 'location'])->name('home.location');
    Route::get('/contacto', [HomeController::class, 'contact'])->name('home.contact');
    
    // Formularios
    Route::get('/reserva/{id}', [ReservationsController::class, 'form'])->name('reservations.form');
    Route::post('/reserva', [ReservationsController::class, 'store'])->name('reservations.store');
});

// Rutas Login Admin
Route::prefix('/')->group(function () {
    Route::get('/login', [AdminController::class, 'showLogin'])->name('login');
    Route::post('/login', [AdminController::class, 'login'])->name('admin.submit');
    Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');
});

// Rutas Dashboard Admin (con middleware de autenticación)
Route::prefix('/dashboard')->middleware('auth')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    
    // Rutas habitaciones
    Route::get('/habitaciones', [RoomsController::class, 'admin'])->name('rooms.admin');
    Route::post('/habitaciones', [RoomsController::class, 'store'])->name('rooms.store');
    Route::delete('/habitaciones/{id}', [RoomsController::class, 'destroy'])->name('rooms.destroy');
    Route::get('/habitaciones/{id}/edit', [RoomsController::class, 'edit'])->name('rooms.edit');
    Route::patch('/habitaciones/{id}', [RoomsController::class, 'update'])->name('rooms.update');
    Route::patch('/habitaciones/{id}/toggle', [RoomsController::class, 'toggleDisp'])->name('rooms.toggle');
    
    // Rutas para reservas
    Route::get('/reservas', [ReservationsController::class, 'admin'])->name('reservations.admin');
    Route::get('/reservas/{id}/show', [ReservationsController::class, 'show'])->name('reservations.show');
    Route::delete('/reservas/{id}', [ReservationsController::class, 'destroy'])->name('reservations.destroy');
    
    // Rutas para pagos
    Route::get('/pagos', [PaymentsController::class, 'admin'])->name('payments.admin');
    Route::post('/pagos', [PaymentsController::class, 'admin'])->name('payments.admin');
    Route::delete('/pagos/{id}', [PaymentsController::class, 'destroy'])->name('payments.destroy');
    Route::patch('/pagos/{id}/toggle', [PaymentsController::class, 'toggleStat'])->name('payments.toggle');
    
    // Rutas para administradores
    Route::get('/admins', [UsersController::class, 'admin'])->name('users.admin');
    Route::post('/admins', [UsersController::class, 'store'])->name('users.store');
    Route::delete('/admins/{id}', [UsersController::class, 'destroy'])->name('users.destroy');
    Route::patch('/admins/{id}', [UsersController::class, 'update'])->name('users.update');
});