<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\ConstrucoesController;

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
    return redirect('home/');
});

Route::get('clientes/buscar', [ClientesController::class, 'buscar']);
Route::resource('clientes', ClientesController::class);

Route::get('construcoes/buscar', [ConstrucoesController::class, 'buscar']);
Route::resource('construcoes', ConstrucoesController::class);

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

