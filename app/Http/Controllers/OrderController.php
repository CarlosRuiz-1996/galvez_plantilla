<?php

namespace App\Http\Controllers;

use App\Models\Detail;
use App\Models\Hospital;
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
    public function index(Request $request)
{
    $query = Order::orderBy('id', 'desc');

    if ($request->filled('hospital_id')) {
        $query->where('hospital_id', $request->input('hospital_id'));
    }

    if ($request->filled('filter_date')) {
        $query->whereDate('created_at', $request->input('filter_date'));
    }

    $pedidos = $query->paginate(10);

    // Obtener la lista de hospitales para el filtro
    $hospitals = Hospital::all();

    return view('admin.orders.index', ['pedidos' => $pedidos, 'hospitals' => $hospitals]);
}



    public function detalle($id)
    {
        $detallePedidos = Detail::where('order_id', $id)->get();
        return view('admin.orders.detalle', ['detallePedidos' => $detallePedidos ]);
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
