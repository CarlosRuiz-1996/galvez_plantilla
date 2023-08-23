<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use Illuminate\Support\Facades\Redirect;


class ProductoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //
    public function index()
    {
        $productos = Producto::orderBy('id', 'desc')->paginate(10);
        // var_dump($productos);
        return view('productos.index', ['productos' => $productos]);
    }

    public function crear()
    {
        return view('productos.crear');
    }


    public function guardar(Request $request)
    {

        //validacion
        $validate = $this->validate($request, [
            'nombre' => ['required', 'string', 'max:255'],
            'descripcion' => ['required', 'string'],
            'stock' => ['required', 'numeric'],
            'precio' => ['required', 'numeric'],

        ]);




        //recoger valores del form
        $nombre = $request->input('nombre');
        $descripcion = $request->input('descripcion');
        $stock = $request->input('stock');
        $precio = $request->input('precio');


        $prodcuto = new Producto();

        $prodcuto->nombre = $nombre;
        $prodcuto->descripcion = $descripcion;
        $prodcuto->stock = $stock;
        $prodcuto->precio = $precio;
        // var_dump($prodcuto);
        // die;

        $prodcuto->save();
        return Redirect::route('producto')->with('status', 'Producto guardado correctamente');
    }


    public function editar($id)
    {
        $producto = Producto::find($id);

        return view('productos.crear', ['producto' => $producto]);
    }


    public function update(Request $request)
    {

        $id = $request->input('id');

        $prodcuto = Producto::findOrFail($id);


        //validacion del form
        $validate = $this->validate($request, [
            'nombre' => ['required', 'string', 'max:255'],
            'descripcion' => ['required', 'string'],
            'stock' => ['required', 'numeric'],
            'precio' => ['required', 'numeric'],

        ]);

        //recoger valores del form
        $nombre = $request->input('nombre');
        $descripcion = $request->input('descripcion');
        $stock = $request->input('stock');
        $precio = $request->input('precio');


        $prodcuto->nombre = $nombre;
        $prodcuto->descripcion = $descripcion;
        $prodcuto->stock = $stock;
        $prodcuto->precio = $precio;


        $prodcuto->update();
        return Redirect::route('producto')->with('status', 'Producto actualizado correctamente');
    }



    public function eliminar ($id){
        $prodcuto = Producto::findOrFail($id);

        // Eliminar el hospital
        $prodcuto->delete();
    
        return redirect()->route('producto')->with('status', 'Producto eliminado correctamente');

    }
}
