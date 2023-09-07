<?php

namespace App\Http\Controllers;

use App\Models\Detail;
use App\Models\Hospital;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DetallePedidosExport; // Ajusta el namespace y el nombre de la clase Export según tus necesidades
use DetallePedidosExport as GlobalDetallePedidosExport;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //
    public function index(Request $request)
{
    // Subconsulta para contar órdenes por hospital
    $subquery = DB::table('orders')
        ->select('hospital_id', DB::raw('COUNT(*) as orders_count'))
        ->groupBy('hospital_id');

    // Consulta principal que se une a la subconsulta
    $query = DB::table('orders as o')
        ->joinSub($subquery, 'subquery', function ($join) {
            $join->on('o.hospital_id', '=', 'subquery.hospital_id');
        })
        ->orderBy('o.id', 'desc')
        ->select('o.hospital_id', 'subquery.orders_count')
        ->distinct();

    // Si se filtra por hospital, aplicar el filtro
    if ($request->filled('hospital_id')) {
        $query->where('o.hospital_id', $request->input('hospital_id'));
    }

    // Obtener la lista de hospitales para el filtro
    $hospitals = Hospital::all();

    // Paginar la consulta de órdenes
    $pedidos = $query->paginate(10);
    //dd($pedidos);
    return view('admin.orders.index', [
        'pedidos' => $pedidos,
        'hospitals' => $hospitals,
    ]);
}

    public function detalleordenes($id)
    {
        

        $detallePedidos = Order::where('hospital_id', $id)->get();

        // var_dump($detallePedidos);
        // die;
        return view('admin.orders.orderdetalleorder', ['detallePedidos' => $detallePedidos ]);
    }

   
    public function exportToExcel()
    {
        return Excel::download(new GlobalDetallePedidosExport, 'tabla_pedidos.xlsx');
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
