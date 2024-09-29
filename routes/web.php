<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::match(['get'], '/', [HomeController::class, 'index'])->name('home.index');

Route::match(['get'],'/admin', function () {
    return view('admin.index');
});
Route::match(['get'],'/login', function () {
    return view('admin.login');
});