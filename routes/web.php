<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EstadoPedidoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\MarcaController;
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