<?php

use App\Http\Controllers\RegistroController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [RegistroController::class, 'index'])->name('mis-registros');
Route::post('/crear-registro', [RegistroController::class, 'store'])->name('crear-registro');
Route::get('mis-registros/{id}',[RegistroController::class, 'registroSelected'])->name('registro-seleccionado');
Route::put('/actualizar-registro', [RegistroController::class, 'update'])->name('actualizar-registro');
Route::put('/inhabilitar-registro', [RegistroController::class, 'disable'])->name('inhabilitar-registro');
Route::put('/habilitar-registro', [RegistroController::class, 'enable'])->name('habilitar-registro');

Route::post('/enviar-correo/{id}', [RegistroController::class, 'enviarCorreo'])->name('enviar.correo');
