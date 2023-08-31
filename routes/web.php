<?php

use App\Http\Controllers\CarritoContoller;
use App\Http\Controllers\HospitalController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
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
    Route::get('admin/hospitals', [HospitalController::class, 'index'])->name('admin.hospitals');
    Route::get('admin/hospitals/detalle/{id?}', [HospitalController::class, 'detalle'])->name('admin.hospitals.detalle');
    Route::get('admin/hospitals/editar/{id?}', [HospitalController::class, 'editar'])->name('admin.hospitals.editar');
    Route::delete('admin/hospitals/eliminar/{id?}', [HospitalController::class, 'eliminar'])->name('admin.hospitals.eliminar');
    Route::put('admin/hospitals/update', [HospitalController::class, 'update'])->name('admin.hospitals.update');

    //prodcutos
    Route::get('admin/products', [ProductController::class, 'index'])->name('admin.products');
    Route::get('admin/products/crear/', [ProductController::class, 'crear'])->name('admin.products.crear');
    Route::post('admin/products/guardar/', [ProductController::class, 'guardar'])->name('admin.products.guardar');
    Route::get('admin/products/editar/{id?}', [ProductController::class, 'editar'])->name('admin.products.editar');
    Route::delete('admin/products/eliminar/{id?}', [ProductController::class, 'eliminar'])->name('admin.products.eliminar');
    Route::post('admin/products/update', [ProductController::class, 'update'])->name('admin.products.update');


    //pedidos
    Route::get('admin/orders', [OrderController::class, 'index'])->name('admin.orders');
    Route::get('/admin/orders/{pedido}/detalle', [OrderController::class, 'detalle'])->name('admin.orders.detalle');
    Route::put('admin/orders/liberar', [OrderController::class, 'liberar'])->name('admin.orders.liberar');
    //carrito
    Route::get('carrito/', [CarritoContoller::class, 'index'])->name('carrito.carrito');
   

});

require __DIR__.'/auth.php';
