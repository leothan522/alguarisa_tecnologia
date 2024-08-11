<?php

use App\Http\Controllers\Dashboard\BienesController;
use App\Http\Controllers\Dashboard\PruebaController;
use App\Http\Controllers\FCM\FcmController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\ParametrosController;
use App\Http\Controllers\Dashboard\UsuariosController;
use App\Http\Controllers\Chat\ChatController;
use App\Http\Controllers\Dashboard\EmpresasController;
use App\Http\Controllers\Dashboard\TerritorioController;

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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'user.admin',
    'user.estatus',
    'user.permisos'
])->prefix('/dashboard')->group(function (){

    Route::get('fcm', [FcmController::class, 'index'])->name('fcm.index');

    Route::get('parametros', [ParametrosController::class, 'index'])->name('parametros.index');
    Route::get('usuarios', [UsuariosController::class, 'index'])->name('usuarios.index');
    Route::get('export/usuarios/{buscar?}', [UsuariosController::class, 'export'])->name('usuarios.excel');
    Route::get('pruebas', [PruebaController::class, 'index'])->name('pruebas.index');

    //alguarisa
    Route::get('empresas', [EmpresasController::class, 'index'])->name('empresas.index');
    Route::get('territorio', [TerritorioController::class, 'index'])->name('territorio.index');
    Route::get('bienes', [BienesController::class, 'index'])->name('bienes.index');
    Route::get('bienes/export', [BienesController::class, 'export'])->name('bienes.export');
    Route::get('bienes/{id}/etiquetas/', [BienesController::class, 'printEtiqueta'])->name('etiquetas.print');

});

Route::get('dashboard/perfil', [UsuariosController::class, 'perfil'])->middleware('auth')->name('usuarios.perfil');
Route::get('chat-directo/{id?}', [ChatController::class, 'index'])->middleware(['user.android'])->name('chat.directo');
Route::get('bienes/{id}/consulta', [BienesController::class, 'webEtiqueta'])->name('etiquetas.web');



