<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Categories;
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
        $productos = Product::orderBy('descripcion', 'asc')->paginate(10);
        // var_dump($productos);
        return view('admin.products.index', ['productos' => $productos]);
    }

    public function crear()
    {
        $brands = Brand::all();
        $ieps = Ieps::all();
        $iva = Iva::all();
        $categorias = Categories::all();
        $grammages = Grammage::all();
        $presentations = Presentation::all();
        return view('admin.products.crear', compact('brands', 'ieps', 'iva', 'grammages', 'presentations','categorias'));
    }
    public function editar($id)
    {
        $brands = Brand::all();
        $ieps = Ieps::all();
        $iva = Iva::all();
        $grammages = Grammage::all();
        $presentations = Presentation::all();
        $producto = Product::findOrFail($id);
        $categorias = Categories::all();
        return view('admin.products.crear', compact('producto', 'brands', 'ieps', 'iva', 'grammages', 'presentations','categorias'));
    }


    public function guardar(Request $request)
    {

        $validate = $this->validate($request, [
            'descripcion' => ['required', 'string', 'max:250'],
            'grammage_id' => ['required', 'numeric'],
            'presentation_id' => ['required', 'numeric'],
            'brand_id' => ['required', 'numeric'],
            'price' => ['required', 'numeric'],
            'iva_id' => ['required', 'numeric'],
            'ieps_id' => ['required', 'numeric'],
            'total' => ['required', 'numeric'],
            'stock' => ['required', 'numeric'],
            'categoria' => ['required', 'numeric'],
        ],[
            'descripcion.required' => 'La descripción es obligatoria.',
            'grammage_id.required' => 'El gramage es obligatorio.',
            'presentation_id.required' => 'El tipo de presentación es obligatorio.',
            'brand_id.required' => 'La marca es obligatorio.',
            'price.required' => 'El precio es obligatorio.',
            'iva_id.required' => 'El IVA es obligatorio.',
            'ieps_id.required' => 'El IEPS es obligatorio.',
            'total.required' => 'El total es obligatorio.',
            'categoria.required' => 'El stock es obligatorio.',
            'stock.required' => 'El stock es obligatorio.',
        ]);
        //recoger valores del form
        $descripcion = $request->input('descripcion');
        $grammage_id = $request->input('grammage_id');
        $presentation_id = $request->input('presentation_id');
        $brand_id = $request->input('brand_id');
        $price = $request->input('price');
        $iva_id = $request->input('iva_id');
        $ieps_id = $request->input('ieps_id');
        $total = $request->input('total');
        $stock = $request->input('stock');
        $categoria = $request->input('categoria');
        //creo nuevo model
        $product = new Product();


        //asignar nuevos valores al objeto prodcuto
        $product->descripcion = $descripcion;
        $product->grammage_id = intval($grammage_id);
        $product->presentation_id = intval($presentation_id);
        $product->brand_id = intval($brand_id);
        $product->price = floatval($price);
        $product->iva_id = intval($iva_id);
        $product->ieps_id = intval($ieps_id);
        $product->total = floatval($total);
        $product->stock = intval($stock);
        $product->category_id = intval($categoria);
        $product->save();
        return redirect()->route('admin.products')->with('status', 'Producto guardado exitosamente.');

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
            'categoria' => ['required', 'numeric'],
        ], [
            'descripcion.required' => 'La descripción es obligatoria.',
            'grammage_id.required' => 'El gramage es obligatorio.',
            'presentation_id.required' => 'El tipo de presentación es obligatorio.',
            'brand_id.required' => 'La marca es obligatorio.',
            'price.required' => 'El precio es obligatorio.',
            'iva_id.required' => 'El IVA es obligatorio.',
            'ieps_id.required' => 'El IEPS es obligatorio.',
            'stock.required' => 'El stock es obligatorio.',
            'categoria.required' => 'La categoria es obligatoria',
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
        $producto->category_id = $request->input('categoria');
        // También puedes asignar los campos restantes aquí

        // Guardar los cambios en el modelo
        try {
            $producto->save();
            return redirect()->route('admin.products')->with('status', 'Producto actualizado exitosamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Hubo un error al actualizar el producto: ' . $e->getMessage());
        }
    }




    public function eliminar($id)
    {
        $prodcuto = Product::findOrFail($id);

        // Eliminar el hospital
        $prodcuto->delete();

        return redirect()->route('admin.products')->with('status', 'Producto eliminado correctamente');
    }
    public function buscarCategoria(Request $request)
{
    $descripcion = $request->input('descripcion');
    $categoria = 'Sin categoría';

    // Realiza una consulta a la base de datos para buscar categorías que coincidan con las palabras clave
    $categorias = Categories::where(function ($query) use ($descripcion) {
        $palabras = explode(' ', $descripcion);
        foreach ($palabras as $palabra) {
            $query->orWhere('palabra_clave', 'like', '%' . $palabra . '%');
        }
    })->first();

    if ($categorias) {
        $categoria = $categorias;
    }

    return response()->json(['categoria' => $categoria]);
}
}
