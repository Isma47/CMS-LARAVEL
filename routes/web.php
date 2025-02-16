<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Auth\LoginController;


//Renderiza el login;
Route::get('/', [PageController::class, 'login'])->name('login');
//Renderiza el dashboard
Route::get('/dashboard/{name}', [PageController::class, 'dashboard'])->name('dashboard');



//Enviamos el login para autheticar
Route::post('/login', [LoginController::class, 'login'])->middleware('throttle:5,1')->name('login.attempt');


