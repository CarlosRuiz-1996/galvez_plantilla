<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;
use Illuminate\Support\Facades\Redirect;
class PedidoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //
    public function index()
    {
        $pedidos = Pedido::orderBy('id', 'desc')->paginate(10);
        // $pedidos = Pedido::with('hospital')->get();

        // var_dump($productos);
        return view('pedidos.index', ['pedidos' => $pedidos]);
    }


    public function detalle($id)
    {
        $pedido = Pedido::find($id);
        // $pedido = Pedido::with('detalles')->find($id);


        return view('pedidos.detalle', ['pedido' => $pedido]);
    }

    public function liberar(Request $request)
    {

        $id = $request->input('id');
// var_dump($id);
// die;
        $pedido = Pedido::findOrFail($id);
        $pedido->estatus = 0;
        $pedido->update();
        return Redirect::route('pedido')->with('status', 'Pedido liberado con exito');
    }
}
