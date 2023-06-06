<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EstadoPedidoController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware('can:Ver dashboard')->name('dashboard');
});

//Para los roles
Route::resource('roles',RoleController::class)->names('admin.roles');

//Para los usuarios
//only en este caso solo creara las rutas index, edit, update
Route::resource('users',UserController::class)->only(['index', 'edit', 'update'])->names('admin.users');

//Para los estados del pedido
Route::resource('estado-pedido',EstadoPedidoController::class)->names('admin.estado-pedido');
