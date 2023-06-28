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
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\AlmacenController;
use App\Http\Controllers\NotaCompraController;
use App\Http\Controllers\CuotaController;
use App\Http\Controllers\PlanPagoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\TelefonoController;
use App\Http\Controllers\NotaVentaController;

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
//Route::resource('users',UserController::class)->only(['index', 'edit', 'update'])->names('admin.users');
Route::get('users', [UserController::class, 'index'])->name('admin.users.index');
Route::get('users/create', [UserController::class, 'create'])->name('admin.users.create');
Route::post('users', [UserController::class, 'store'])->name('admin.users.store');
Route::get('users/{user}', [UserController::class, 'show'])->name('admin.users.show');
Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
Route::get('users/{user}/rol', [UserController::class, 'rol'])->name('admin.users.rol');
Route::put('rol/{user}', [UserController::class, 'updateRol'])->name('admin.users.updateRol');
Route::put('users/{user}', [UserController::class, 'update'])->name('admin.users.update');
Route::delete('users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');

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
//----------------------------------------------------------------------------------------------------------------
//Para los PROVEEDORES -------------------------------------------------------------------------------------------
Route::get('proveedor', [ProveedorController::class, 'index'])->name('admin.proveedor.index');
Route::get('proveedor/create', [ProveedorController::class, 'create'])->name('admin.proveedor.create');
Route::post('proveedor', [ProveedorController::class, 'store'])->name('admin.proveedor.store');
Route::get('proveedor/{proveedor}', [ProveedorController::class, 'show'])->name('admin.proveedor.show');
Route::get('proveedor/{proveedor}/edit', [ProveedorController::class, 'edit'])->name('admin.proveedor.edit');
Route::put('proveedor/{proveedor}', [ProveedorController::class, 'update'])->name('admin.proveedor.update');
Route::delete('proveedor/{proveedor}', [ProveedorController::class, 'destroy'])->name('admin.proveedor.destroy');

//Para los ALMACENES -------------------------------------------------------------------------------------------
Route::get('almacen', [AlmacenController::class, 'index'])->name('admin.almacen.index');
Route::get('almacen/create', [AlmacenController::class, 'create'])->name('admin.almacen.create');
Route::post('almacen', [AlmacenController::class, 'store'])->name('admin.almacen.store');
Route::get('almacen/{almacen}', [AlmacenController::class, 'show'])->name('admin.almacen.show');
Route::get('almacen/{almacen}/edit', [AlmacenController::class, 'edit'])->name('admin.almacen.edit');
Route::put('almacen/{almacen}', [AlmacenController::class, 'update'])->name('admin.almacen.update');
Route::delete('almacen/{almacen}', [AlmacenController::class, 'destroy'])->name('admin.almacen.destroy');
Route::get('almacen/{id}/pdf',  [AlmacenController::class, 'generarPDF'])->name('almacen.pdf');

//Para NOTA COMPRA -------------------------------------------------------------------------------------------
Route::get('nota_compra', [NotaCompraController::class, 'index'])->name('admin.nota_compra.index');
Route::get('nota_compra/create', [NotaCompraController::class, 'create'])->name('admin.nota_compra.create');
Route::post('nota_compra', [NotaCompraController::class, 'store'])->name('admin.nota_compra.store');
Route::get('nota_compra/{nota_compra}', [NotaCompraController::class, 'show'])->name('admin.nota_compra.show');
Route::get('nota_compra/{nota_compra}/edit', [NotaCompraController::class, 'edit'])->name('admin.nota_compra.edit');
Route::put('nota_compra/{nota_compra}', [NotaCompraController::class, 'update'])->name('admin.nota_compra.update');
Route::delete('nota-compra/{nota_compra}', [NotaCompraController::class, 'destroy'])->name('admin.nota_compra.destroy');
//Route::get('nota_compra/{nota_compras}/pdf', [NotaCompraController::class, 'generarPDF'])->name('admin.nota_compra.pdf');
//Route::get('nota_compra/pdf', [NotaCompraController::class, 'generarPDF'])->name('admin.nota_compra.pdf');

//PARA LAS CUOTAS
Route::get('cuota', [CuotaController::class, 'index'])->name('cuota.index');
Route::get('cuota/create', [CuotaController::class, 'create'])->name('cuota.create');
Route::post('cuota', [CuotaController::class, 'store'])->name('cuota.store');
Route::get('cuota/{cuota}', [CuotaController::class, 'show'])->name('cuota.show');
Route::get('cuota/{cuota}/edit', [CuotaController::class, 'edit'])->name('cuota.edit');
Route::put('cuota/{cuota}', [CuotaController::class, 'update'])->name('cuota.update');
Route::delete('cuota/{cuota}', [CuotaController::class, 'destroy'])->name('cuota.destroy');

//PARA LOS PLANES DE PAGO
Route::get('pago', [PlanPagoController::class, 'index'])->name('plan-pago.index');
Route::get('pago/create', [PlanPagoController::class, 'create'])->name('plan-pago.create');
Route::post('pago', [PlanPagoController::class, 'store'])->name('plan-pago.store');
Route::get('pago/{pago}', [PlanPagoController::class, 'show'])->name('plan-pago.show');
Route::get('pago/{pago}/edit', [PlanPagoController::class, 'edit'])->name('plan-pago.edit');
Route::put('pago/{pago}', [PlanPagoController::class, 'update'])->name('plan-pago.update');
Route::delete('pago/{pago}', [PlanPagoController::class, 'destroy'])->name('plan-pago.destroy');

//PARA LOS CLIENTES
Route::get('cliente', [ClienteController::class, 'index'])->name('cliente.index');
Route::get('cliente/create', [ClienteController::class, 'create'])->name('cliente.create');
Route::post('cliente', [ClienteController::class, 'store'])->name('cliente.store');
Route::get('cliente/{cliente}', [ClienteController::class, 'show'])->name('cliente.show');
Route::get('cliente/{cliente}/edit', [ClienteController::class, 'edit'])->name('cliente.edit');
Route::put('cliente/{cliente}', [ClienteController::class, 'update'])->name('cliente.update');
Route::delete('cliente/{cliente}', [ClienteController::class, 'destroy'])->name('cliente.destroy');

//PARA LOS TELEFONOS
Route::get('telefono', [TelefonoController::class, 'index'])->name('telefono.index');
Route::get('telefono/create', [TelefonoController::class, 'create'])->name('telefono.create');
Route::post('telefono', [TelefonoController::class, 'store'])->name('telefono.store');
Route::get('telefono/{telefono}', [TelefonoController::class, 'show'])->name('telefono.show');
Route::get('telefono/{telefono}/edit', [TelefonoController::class, 'edit'])->name('telefono.edit');
Route::put('telefono/{telefono}', [TelefonoController::class, 'update'])->name('telefono.update');
Route::delete('telefono/{telefono}', [TelefonoController::class, 'destroy'])->name('telefono.destroy');

//PARA LAS NOTA VENTA
Route::get('nota_venta', [NotaVentaController::class, 'index'])->name('nota_venta.index');
Route::get('nota_venta/create', [NotaVentaController::class, 'create'])->name('nota_venta.create');
Route::post('nota_venta', [NotaVentaController::class, 'store'])->name('nota_venta.store');
Route::get('nota_venta/{nota_venta}', [NotaVentaController::class, 'show'])->name('nota_venta.show');
Route::get('nota_venta/{nota_venta}/edit', [NotaVentaController::class, 'edit'])->name('nota_venta.edit');
Route::put('nota_venta/{nota_venta}', [NotaVentaController::class, 'update'])->name('nota_venta.update');
Route::delete('nota_venta/{nota_venta}', [NotaVentaController::class, 'destroy'])->name('nota_venta.destroy');