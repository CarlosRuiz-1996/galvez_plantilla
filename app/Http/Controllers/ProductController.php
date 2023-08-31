<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Grammage;
use App\Models\Ieps;
use App\Models\Iva;
use App\Models\Presentation;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Redirect;


class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //
    public function index()
    {
        $productos = Product::orderBy('id', 'desc')->paginate(10);
        // var_dump($productos);
        return view('admin.products.index', ['productos' => $productos]);
    }

    public function crear()
    {
        $brands = Brand::all();
        $ieps = Ieps::all();
        $iva = Iva::all();
        $grammages = Grammage::all();
        $presentations = Presentation::all();
        return view('admin.products.crear', compact('brands', 'ieps', 'iva','grammages','presentations'));
    }
    public function editar($id)
    {
        $brands = Brand::all();
        $ieps = Ieps::all();
        $iva = Iva::all();
        $grammages = Grammage::all();
        $presentations = Presentation::all();
        $producto = Product::findOrFail($id);
    
        return view('admin.products.crear', compact('producto', 'brands', 'ieps', 'iva', 'grammages', 'presentations'));
    }


    public function guardar(Request $request)
    {
        // Validación
        $validate = $request->validate([
            'descripcion' => ['required', 'string'],
            'grammage_id' => ['required', 'numeric'],
            'presentation_id' => ['required', 'numeric'],
            'brand_id' => ['required', 'numeric'],
            'price' => ['required', 'numeric'],
            'iva_id' => ['required', 'numeric'],
            'ieps_id' => ['required', 'numeric'],
            'stock' => ['required', 'numeric'],
        ], [
            'descripcion.required' => 'La descripción es obligatoria.',
            'grammage_id.required' => 'El gramage es obligatorio.',
            'presentation_id.required' => 'El tipo de presentación es obligatorio.',
            'brand_id.required' => 'La marca es obligatorio.',
            'price.required' => 'El precio es obligatorio.',
            'iva_id.required' => 'El IVA es obligatorio.',
            'ieps_id.required' => 'El IEPS es obligatorio.',
            'stock.required' => 'El stock es obligatorio.',
        ]);
    
        // Realizar el cálculo del total
        $iva = Iva::find($request->iva_id)->amount;
        $ieps = Ieps::find($request->ieps_id)->amount;
        $precio = $request->price;
        $total = $precio + ($precio * $iva / 100) + ($precio * $ieps / 100);
    
        // Crear y guardar el producto
        $producto = new Product();
        $producto->descripcion = $request->descripcion;
        $producto->grammage_id = $request->grammage_id;
        $producto->presentation_id = $request->presentation_id;
        $producto->brand_id = $request->brand_id;
        $producto->price = $precio;
        $producto->iva_id = $request->iva_id;
        $producto->ieps_id = $request->ieps_id;
        $producto->total = $total;
        $producto->stock = $request->stock;
    
            $producto->save();
            return redirect()->route('admin.products')->with('success', 'Producto guardado exitosamente.');
    }
    


    public function update(Request $request)
    {
        $id = $request->input('id');
        $producto = Product::findOrFail($id);
    
        // Validación similar a la función guardar
        $validate = $request->validate([
            'descripcion' => ['required', 'string'],
            'grammage_id' => ['required', 'numeric'],
            'presentation_id' => ['required', 'numeric'],
            'brand_id' => ['required', 'numeric'],
            'price' => ['required', 'numeric'],
            'iva_id' => ['required', 'numeric'],
            'ieps_id' => ['required', 'numeric'],
            'stock' => ['required', 'numeric'],
        ], [
            'descripcion.required' => 'La descripción es obligatoria.',
            'grammage_id.required' => 'El gramage es obligatorio.',
            'presentation_id.required' => 'El tipo de presentación es obligatorio.',
            'brand_id.required' => 'La marca es obligatorio.',
            'price.required' => 'El precio es obligatorio.',
            'iva_id.required' => 'El IVA es obligatorio.',
            'ieps_id.required' => 'El IEPS es obligatorio.',
            'stock.required' => 'El stock es obligatorio.',
        ]);
    
        // Actualizar valores del formulario en el modelo
        $producto->descripcion = $request->input('descripcion');
        $producto->grammage_id = $request->input('grammage_id');
        $producto->presentation_id = $request->input('presentation_id');
        $producto->brand_id = $request->input('brand_id');
        $producto->price = $request->input('price');
        $producto->iva_id = $request->input('iva_id');
        $producto->ieps_id = $request->input('ieps_id');
        $producto->stock = $request->input('stock');
        // También puedes asignar los campos restantes aquí
    
        // Guardar los cambios en el modelo
        try {
            $producto->save();
            return redirect()->route('admin.products')->with('success', 'Producto actualizado exitosamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Hubo un error al actualizar el producto: ' . $e->getMessage());
        }
    }
    



    public function eliminar ($id){
        $prodcuto = Product::findOrFail($id);

        // Eliminar el hospital
        $prodcuto->delete();
    
        return redirect()->route('admin.products')->with('status', 'Producto eliminado correctamente');

    }
}
