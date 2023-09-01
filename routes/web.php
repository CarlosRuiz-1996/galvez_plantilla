<?php

use App\Http\Controllers\admin\CatalogController;
use App\Http\Controllers\CarritoContoller;
use App\Http\Controllers\HospitalController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;


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
    
    Route::get('hospitals/asignar', [HospitalController::class, 'list'])->name('hospitals.asignar');
    Route::post('hospitals/asignar/save', [HospitalController::class, 'asignar'])->name('hospitals.asignar.save');

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
    //catalogos
    Route::get('admin/catalogs', [CatalogController::class, 'index'])->name('admin.catalogs');
    Route::get('admin/catalogs/show/{ctg?}', [CatalogController::class, 'show'])->name('admin.catalogs.show');
    Route::get('admin/catalogs/crear/{ctg?}', [CatalogController::class, 'create'])->name('admin.catalogs.crear');
    Route::get('admin/catalogs/edit/{ctg?}/{id?}', [CatalogController::class, 'edit'])->name('admin.catalogs.edit');
    Route::post('admin/catalogs/guardar/{ctg?}', [CatalogController::class, 'store'])->name('admin.catalogs.guardar');
    Route::post('admin/catalogs/update/{ctg?}', [CatalogController::class, 'update'])->name('admin.catalogs.update');
    Route::get('admin/catalogs/destroy/{ctg?}/{id?}', [CatalogController::class, 'destroy'])->name('admin.catalogs.destroy');
    Route::get('admin/catalogs/reactivar/{ctg?}/{id?}', [CatalogController::class, 'reactivar'])->name('admin.catalogs.reactivar');

    //carrito
    Route::get('carrito/', [CarritoContoller::class, 'index2'])->name('carrito.carrito');
    Route::post('carrito/add-to-cart/{product}', [CarritoContoller::class, 'addToCart'])->name('cart.add');
    Route::get('carrito/cart', [CarritoContoller::class, 'viewCart'])->name('cart.viewCart');
    Route::get('carrito/update/{id?}/{accion?}', [CarritoContoller::class, 'updateCart'])->name('cart.update');
    Route::get('carrito/removeProduct/{productId?}', [CarritoContoller::class, 'removeProduct'])->name('cart.removeProduct');
    Route::post('carrito/generar-pedido', [CarritoContoller::class, 'generarPedido'])->name('cart.generarPedido');

});

require __DIR__ . '/auth.php';
