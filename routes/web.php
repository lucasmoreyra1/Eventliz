<?php

use App\Http\Controllers\ClientesController;
use App\Http\Controllers\eventosController;
use App\Http\Controllers\ParticipantesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IngresoEgresoController;
use App\Http\Controllers\LocacionesController;
use App\Http\Controllers\menuController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\TipoEventoController;
use Illuminate\Support\Facades\Auth;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

//Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\eventosController::class, 'index'])->name('eventos-index');


Route::get('/eventos/archivar/{id}', [App\Http\Controllers\eventosController::class, 'archivar'])->name('archivar-evento');
Route::get('/eventos/finalizar/{id}', [App\Http\Controllers\eventosController::class, 'finalizar'])->name('evento.finalizar');
Route::get('/eventos/activar/{id}', [App\Http\Controllers\eventosController::class, 'activar'])->name('evento.activar');
Route::get('/eventos/archivados', [App\Http\Controllers\eventosController::class, 'verArchivados'])->name('eventos.archivados');
Route::get('/eventos/finalizados', [App\Http\Controllers\eventosController::class, 'verFinalizados'])->name('eventos.finalizados');
Route::get('/eventos/proximos', [App\Http\Controllers\eventosController::class, 'proximosEventos'])->name('eventos.proximos');


Route::get('/participantes/eventos/{id}', [ParticipantesController::class, 'index' ])->name('participantes.mostrar');
Route::get('/participantes/create/{id}', [ParticipantesController::class, 'create' ])->name('participantes.crear');
Route::get('/agregar/create/{id}', [ParticipantesController::class, 'create'])->name('agregar.create');
Route::get('/participantes/pago/{id}', [ParticipantesController::class, 'pagoParticipante'])->name('participantes.pago');
Route::get('/participantes/generarExcel/{id}', [ParticipantesController::class, 'generarExcel'])->name('participantes.GenerarExcel');
Route::post('/participantes/subirExcel/{id}', [ParticipantesController::class, 'subirExcel'])->name('participantes.subirExcel');

Route::get('/fondos/evento/{id}', [IngresoEgresoController::class, 'index' ])->name('fondos.mostrar');
Route::get('/agregar/pago/{id}', [IngresoEgresoController::class, 'create'])->name('agregar.pago');



Route::post('/eventos/nombre', [PerfilController::class, 'cambiarNombre'])->name('perfil.nombre');
Route::post('/eventos/email', [PerfilController::class, 'cambiarEmail'])->name('perfil.email');
Route::post('/eventos/password', [PerfilController::class, 'cambiarPassword'])->name('perfil.password');

Route::resource('/perfil', PerfilController::class);
Route::resource('/eventos', eventosController::class);
Route::resource('/participantes', ParticipantesController::class);
Route::resource('/locaciones', LocacionesController::class);
Route::resource('/menus', menuController::class);
Route::resource('/clientes', ClientesController::class);
Route::resource('/tipoEventos', TipoEventoController::class);
Route::resource('/fondos', IngresoEgresoController::class);

