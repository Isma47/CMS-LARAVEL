<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\App\Admin\Users\UserController;



//Renderiza el login;
Route::get('/', [PageController::class, 'login'])->name('login');
//Enviamos el login para autheticar
Route::post('/login', [LoginController::class, 'login'])->middleware('throttle:5,1')->name('login.attempt');


// Grupo de rutas publicas protegidas con auth
Route::middleware(['auth'])->group(function () {
    // Renderiza el dashboard
    Route::get('/dashboard', [PageController::class, 'dashboard'])->name('dashboard');

    // Muestra una publicación específica
    Route::get('/publication/{id}', [PageController::class, 'publication'])
        ->where('id', '[0-9]+')
        ->name('publications.show');

    // Filtra publicaciones por categorías
    Route::get('/dashboard/categories', [PageController::class, 'getPublicationCategorie'])
        ->name('publications.categories');
});



//crear, actualizar, elimianr usuarios 
Route::middleware(['auth'])->group(function () {

    //renderiza el dashboard  administrador
    Route::get('/dashboard-admin', [PageController::class, 'dashboardAdmin'])->name('dashboard.admin');

    //Creamos formulario para la creación de usuairios
    Route::get('admin/create_user', [UserController::class, 'createUser'])->name('admin.createUser');
    //Registrar usuario
    Route::post('user/create', [UserController::class, 'registerUser'])->name('user.create');



    //Panel de actualizar y eliminacion de usuarios
    Route::get('admin/users', [UserController::class, 'adminUser'])->name('admin.updateUser');
    //Renderizra el formualrio con la info del usuairo seleccionado
    Route::get('update/update_user/{id}', [UserController::class, 'getFormUser'])->name('users.edit');
    Route::put('update_user', [UserController::class, 'updateUser'])->name('users.update');

    //Eliminar usuairos
    Route::delete('delete/delete_user', [UserController::class, 'deleteUsers'])->name('users.destroy'); 


});


//


