<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Redirect;
class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //
    public function index()
    {
        $pedidos = Order::orderBy('id', 'desc')->paginate(10);
        // $pedidos = Pedido::with('hospital')->get();

        // var_dump($productos);
        return view('admin.orders.index', ['pedidos' => $pedidos]);
    }


    public function detalle($id)
    {
        $pedido = Order::find($id);
        // $pedido = Pedido::with('detalles')->find($id);


        return view('admin.orders.detalle', ['pedido' => $pedido]);
    }

    public function liberar(Request $request)
    {

        $id = $request->input('id');
        // var_dump($id);
        // die;
        $pedido = Order::findOrFail($id);
        $pedido->estatus = 0;
        $pedido->update();
        return Redirect::route('admin.orders')->with('status', 'Pedido liberado con exito');
    }
}
