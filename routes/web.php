<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Middleware\AdminMiddleware; // deifne isel suairo es admin 
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\App\Admin\Users\UserController;
use App\Http\Controllers\App\Admin\Categories\CategoriesController;
use App\Http\Controllers\App\Admin\Publications\PublicationsController;



//Renderiza el login;
Route::get('/', [PageController::class, 'login'])->name('login');
//Enviamos el login para autheticar
Route::post('/login', [LoginController::class, 'login'])->middleware('throttle:5,1')->name('login.attempt');

Route::post('/logout', [LoginController::class, 'logout'])->middleware('throttle:5,1')->name('logout');



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
Route::middleware(['auth', AdminMiddleware::class])->group(function () {

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


//Crear actualizar y eliminar publicaciones
// Rutas protegidas con middleware auth
Route::middleware(['auth', AdminMiddleware::class])->group(function () {

    // Panel de administración de publicaciones
    //  Panel de publicaciones (Lista de Publicaciones)
    Route::get('admin/publications', [PublicationsController::class, 'indexPublicacions'])->name('admin.publications');


    //  Formulario para crear una publicación
    Route::get('admin/publications/create', [PublicationsController::class, 'createPublicationForm'])->name('admin.publications.create');

    // Guardar nueva publicación
    Route::post('admin/publications/store', [PublicationsController::class, 'createPublication'])->name('admin.publications.store');

    // Panel para editar una publicación
    Route::get('admin/publications/{id}/edit', [PublicationsController::class, 'editPublication'])->name('admin.publications.edit');

    // Actualizar publicación
    Route::put('admin/publications/update', [PublicationsController::class, 'updatePublication'])->name('admin.publications.update');


    // Eliminar publicación
    Route::delete('admin/publications/delete', [PublicationsController::class, 'deletePublication'])->name('admin.publications.destroy');
});



Route::middleware(['auth', AdminMiddleware::class])->group(function () {

    //Fomurlairo para crear catgeorias 
    Route::get('admin/categories/create', [CategoriesController::class, 'createForm'])->name('admin.categories.create');
    //Crar las categorias
    Route::post('admin/categories/store', [CategoriesController::class, 'store'])->name('admin.categories.store');

    //Entra al panel de todas las categorias
    Route::get('admin/categories', [CategoriesController::class, 'dashboardCategories'])->name('admin.categories');

    
    Route::get('admin/categories/{id}/edit', [CategoriesController::class, 'editcategories'])->name('admin.categories.edit');



    Route::put('admin/categories/update', [CategoriesController::class, 'updateCategories'])->name('admin.categories.update');


    //Eliminar
    Route::delete('admin/categories/destroy', [CategoriesController::class, 'destroy'])->name('admin.categories.destroy');



});
