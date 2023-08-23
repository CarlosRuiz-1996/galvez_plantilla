<?php

use App\Http\Controllers\HospitalController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //hospitales
    Route::get('/hospitales', [HospitalController::class, 'index'])->name('hospital');
    Route::get('/hospitales/detalle/{id?}', [HospitalController::class, 'detalle'])->name('hospital.detalle');
    Route::get('/hospitales/editar/{id?}', [HospitalController::class, 'editar'])->name('hospital.editar');
    Route::delete('/hospitales/eliminar/{id?}', [HospitalController::class, 'eliminar'])->name('hospital.eliminar');
    Route::put('/hospitales/update', [HospitalController::class, 'update'])->name('hospital.update');

    //prodcutos
    Route::get('/productos', [ProductoController::class, 'index'])->name('producto');
    Route::get('/productos/crear/', [ProductoController::class, 'crear'])->name('producto.crear');
    Route::post('/productos/guardar/', [ProductoController::class, 'guardar'])->name('producto.guardar');
    Route::get('/productos/editar/{id?}', [ProductoController::class, 'editar'])->name('producto.editar');
    Route::delete('/productos/eliminar/{id?}', [ProductoController::class, 'eliminar'])->name('producto.eliminar');
    Route::post('/productos/update', [ProductoController::class, 'update'])->name('producto.update');

    //pedidos
    Route::get('/pedidos', [PedidoController::class, 'index'])->name('pedido');
    Route::get('/pedidos/detalle/{id?}', [PedidoController::class, 'detalle'])->name('pedido.detalle');

    // Route::get('/pedidos/crear/', [PedidoController::class, 'crear'])->name('pedido.crear');
    // Route::post('/pedidos/guardar/', [PedidoController::class, 'guardar'])->name('pedido.guardar');
    Route::put('/pedidos/liberar', [PedidoController::class, 'liberar'])->name('pedido.liberar');
    // Route::delete('/pedidos/eliminar/{id?}', [PedidoController::class, 'eliminar'])->name('pedido.eliminar');
    // Route::post('/pedidos/update', [PedidoController::class, 'update'])->name('pedido.update');

});

require __DIR__.'/auth.php';
