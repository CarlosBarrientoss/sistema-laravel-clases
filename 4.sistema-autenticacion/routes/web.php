<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('usuarios', UserController::class);
    Route::patch('usuarios/{usuario}/toggle', [UserController::class, 'toggleStatus'])->name('usuarios.toggle');
    Route::get('dashboard', function () { return view('dashboard');})->name('dashboard');
});


Route::middleware('guest')->group(function () {
    Route::get('login', function () { return view('autenticacion.login');})->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login.post');
});

