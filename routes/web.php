<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PedidoController;
use App\Http\Livewire\PedidoEditor;


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
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/create/pedido', [PedidoController::class, 'create'])
->name('create.pedido')
->middleware('verificar.perfil:Solicitante');

Route::post('/store/pedido', [PedidoController::class, 'store'])
->name('store.pedido')
->middleware('verificar.perfil:Solicitante');

Route::post('/store/pedido', [PedidoController::class, 'store'])
->name('store.pedido');

Route::get('show/pedido/{id}', [PedidoController::class, 'show'])
->name('show.pedido');

Route::patch('update/pedido/{id}', [PedidoController::class, 'update'])
->name('update.pedido');
