<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EstadoPedidoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\PosicionController;
use App\Http\Controllers\VehiculoController;
use App\Http\Controllers\ParabrisaController;

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

//Para las categorias -------------------------------------------------------------------------------------------------
Route::get('categoria', [CategoriaController::class, 'index'])->name('admin.categoria.index');
Route::get('categoria/create', [CategoriaController::class, 'create'])->name('admin.categoria.create');
Route::post('categoria', [CategoriaController::class, 'store'])->name('admin.categoria.store');
Route::get('categoria/{categoria}', [CategoriaController::class, 'show'])->name('admin.categoria.show');
Route::get('categoria/{categoria}/edit', [CategoriaController::class, 'edit'])->name('admin.categoria.edit');
Route::put('categoria/{categoria}', [CategoriaController::class, 'update'])->name('admin.categoria.update');
Route::delete('categoria/{categoria}', [CategoriaController::class, 'destroy'])->name('admin.categoria.destroy');
//----------------------------------------------------------------------------------------------------------------------
//Para las MARCAS ---------------------------------------------------------------------------------------------------
Route::get('marca', [MarcaController::class, 'index'])->name('admin.marca.index');
Route::get('marca/create', [MarcaController::class, 'create'])->name('admin.marca.create');
Route::post('marca', [MarcaController::class, 'store'])->name('admin.marca.store');
Route::get('marca/{marca}', [MarcaController::class, 'show'])->name('admin.marca.show');
Route::get('marca/{marca}/edit', [MarcaController::class, 'edit'])->name('admin.marca.edit');
Route::put('marca/{marca}', [MarcaController::class, 'update'])->name('admin.marca.update');
Route::delete('marca/{marca}', [MarcaController::class, 'destroy'])->name('admin.marca.destroy');
//-------------------------------------------------------------------------------------------------------------------
//Para la POSICION --------------------------------------------------------------------------------------------------
Route::get('posicion', [PosicionController::class, 'index'])->name('admin.posicion.index');
Route::get('posicion/create', [PosicionController::class, 'create'])->name('admin.posicion.create');
Route::post('posicion', [PosicionController::class, 'store'])->name('admin.posicion.store');
Route::get('posicion/{posicion}', [PosicionController::class, 'show'])->name('admin.posicion.show');
Route::get('posicion/{posicion}/edit', [PosicionController::class, 'edit'])->name('admin.posicion.edit');
Route::put('posicion/{posicion}', [PosicionController::class, 'update'])->name('admin.posicion.update');
Route::delete('posicion/{posicion}', [PosicionController::class, 'destroy'])->name('admin.posicion.destroy');
//Para los VEHICULOS ---------------------------------------------------------------------------------------------
Route::get('vehiculo', [VehiculoController::class, 'index'])->name('admin.vehiculo.index');
Route::get('vehiculo/create', [VehiculoController::class, 'create'])->name('admin.vehiculo.create');
Route::post('vehiculo', [VehiculoController::class, 'store'])->name('admin.vehiculo.store');
Route::get('vehiculo/{vehiculo}', [VehiculoController::class, 'show'])->name('admin.vehiculo.show');
Route::get('vehiculo/{vehiculo}/edit', [VehiculoController::class, 'edit'])->name('admin.vehiculo.edit');
Route::put('vehiculo/{vehiculo}', [VehiculoController::class, 'update'])->name('admin.vehiculo.update');
Route::delete('vehiculo/{vehiculo}', [VehiculoController::class, 'destroy'])->name('admin.vehiculo.destroy');
//----------------------------------------------------------------------------------------------------------------
//Para los PARABRISAS --------------------------------------------------------------------------------------------
Route::get('parabrisa', [ParabrisaController::class, 'index'])->name('admin.parabrisa.index');
Route::get('parabrisa/create', [ParabrisaController::class, 'create'])->name('admin.parabrisa.create');
Route::post('parabrisa', [ParabrisaController::class, 'store'])->name('admin.parabrisa.store');
Route::get('parabrisa/{parabrisa}', [ParabrisaController::class, 'show'])->name('admin.parabrisa.show');
Route::get('parabrisa/{parabrisa}/edit', [ParabrisaController::class, 'edit'])->name('admin.parabrisa.edit');
Route::put('parabrisa/{parabrisa}', [ParabrisaController::class, 'update'])->name('admin.parabrisa.update');
Route::delete('parabrisa/{parabrisa}', [ParabrisaController::class, 'destroy'])->name('admin.parabrisa.destroy');