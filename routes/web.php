<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

Route::get('/', function () {
    return view('landing');
});

// Rutas temporales para autenticación
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// Ruta para el formulario de contacto
Route::post('/contact', [ContactController::class, 'sendMessage'])->name('contact.send');
