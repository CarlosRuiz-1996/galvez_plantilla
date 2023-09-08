<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class almacenController extends Controller
{
    public function index()
    {
        $productos = Product::orderBy('stock', 'asc')
        ->paginate(10);
    
    return view('admin.almacen.almacen', ['productos' => $productos]);
    
    }
    
    public function editStock($id)
    {
        // Buscar el producto por su ID
        $producto = Product::find($id);
    
        // Verificar si el producto existe
        if (!$producto) {
            // Puedes redirigir o mostrar un mensaje de error aquí si el producto no se encuentra
            return redirect()->route('admin.almacen.almacen.index')->with('error', 'Producto no encontrado.');
        }
    
        // Cargar la vista de edición de stock y pasar el producto
        return view('admin.almacen.editStock', ['producto' => $producto]);
    }

    public function updateStock(Request $request, $id)
{
    // Validar el formulario
    $request->validate([
        'stock' => 'required|integer|min:0',
    ]);

    // Buscar el producto por su ID
    $producto = Product::find($id);

    // Verificar si el producto existe
    if (!$producto) {
        // Puedes redirigir o mostrar un mensaje de error aquí si el producto no se encuentra
        return redirect()->route('admin.almacen.almacen.index')->with('error', 'Producto no encontrado.');
    }

    // Actualizar el campo de stock
    $producto->stock =$producto->stock + $request->input('stock');
    $producto->save();

    // Redirigir de vuelta a la vista de lista de productos
    return redirect()->route('admin.almacen')->with('success', 'Stock actualizado correctamente.');
}



}
