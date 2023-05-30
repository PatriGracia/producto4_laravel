<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\ActoController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\PonenteController;
use App\Http\Controllers\TipoactoController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('eventos', InicioController::class)->name('home'); 

Route::controller(PersonaController::class)->group(function(){
    Route::get('personas', 'index');

    Route::get('personas/create', 'create')->name('personas.create');

    Route::get('personas/{id}', 'show')->name('personas.show');
});

Route::controller(LoginController::class)->group(function(){
    Route::view('/login', 'auth/login')->name('login');

    Route::view('/registro', 'auth/registro')->name('registro');

    Route::view('/privada', 'prueba')->middleware('auth')->name('privada');

    Route::view('/admin', 'menu-admin/admin')->middleware('auth')->name('admin');

    Route::view('/usuario', 'menu-usuario/usuario')->middleware('auth')->name('usuario');

    Route::post('/validar-registro', 'register')->name('validar-registro');

    Route::post('/inicia-sesion', 'login')->name('inicia-sesion');

    Route::get('/logout', 'logout')->name('logout');
});

Route::controller(ActoController::class)->group(function(){
    Route::get('/acto/allEvent', 'allEvent')->name('acto.allEvent');

    Route::get('/acto', 'index')->middleware('auth')->name('acto.index');

    Route::post('/acto/showEvent', 'showEvent')->name('acto.showEvent');
    
    Route::post('/acto/datoInsc', 'datoInscribir')->middleware('auth')->name('acto.datoInscribir');

    Route::post('/acto/inscribirDesinscribir', 'inscribirDesinscribir')->name('acto.inscribirDesinscribir');

    Route::post('/acto/create', 'create')->middleware('auth')->name('acto.create');

    Route::post('/acto/edit', 'edit')->middleware('auth')->name('acto.edit');

    Route::post('/acto/delete', 'delete')->middleware('auth')->name('acto.delete');

    Route::post('/subir', 'subirArchivo')->middleware('auth')->name('subir');
});

Route::controller(PonenteController::class)->group(function(){
    Route::get('/ponente', 'index')->middleware('auth')->name('ponente.index');
    Route::post('/ponente/update', 'update')->middleware('auth')->name('ponente.update');
    Route::post('/ponente/delete', 'destroy')->middleware('auth')->name('ponente.delete');
    Route::post('/ponente/store', 'store')->middleware('auth')->name('ponente.store');
});

Route::controller(TipoactoController::class)->group(function(){
    Route::get('/tipo_acto', 'index')->middleware('auth')->name('tipo_acto.index');
    Route::post('/tipo_acto/update', 'update')->middleware('auth')->name('tipo_acto.update');
    Route::post('/tipo_acto/delete', 'destroy')->middleware('auth')->name('tipo_acto.delete');
    Route::post('/tipo_acto/store', 'store')->middleware('auth')->name('tipo_acto.store');
});

Route::controller(PerfilController::class)->group(function(){
    Route::get('/perfil', 'index')->middleware('auth')->name('perfil.index');

    Route::post('/modificar', 'modificar')->middleware('auth')->name('perfil.modificar');
});

Route::controller(AdminController::class)->group(function(){
    Route::view('/admin', 'menu-admin/admin')->middleware('auth')->name('admin');

    
});