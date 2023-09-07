<div class="container">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-1 bg-white border-b border-gray-200">
            <div class="table-container" style="max-height: 420px; overflow-y: auto;">
                <div class="table-responsive">


                    <table class="table border-t border-b border-collapse " id="miTabla">
                        <thead class=" bg-gray-50">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    CLAVE PEDIDO</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    FECHA ENTREGA</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    OBSERVACIONES</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    ESTATUS</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    TOTAL</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    FECHA DE ORDEN</th>

                            </tr>
                        </thead>
                        <tbody class="text-gray-500">
                            @foreach ($detallePedidos as $detallePedido)
                                <tr class="toggle-pedido ">
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-600">{{ $detallePedido->id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap  text-gray-600">
                                        {{ $detallePedido->deadline }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap  text-gray-600">
                                        {{ $detallePedido->observations }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap  text-gray-600">
                                        @if ($detallePedido->status === 1)
                                            Creado
                                        @else
                                            Surtido
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap  text-gray-600">${{ $detallePedido->total }}
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap  text-gray-600">
                                        {{ $detallePedido->updated_at }}</td>


                                </tr>
                                <tr class="detalle-pedido" style="display: none;">
                                    <td colspan="6" class=" bg-slate-100">
                                        <table class="table table-bordered ml-80">
                                            <tbody>
                                                @if($detallePedido->detalles)

                                                @foreach ($detallePedido->detalles as $detalle)
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td>Producto:
                                                            {{ $detalle->product->descripcion }}</td>
                                                        <td>Precio: $ {{ $detalle->product->price }}</td>
                                                        <td> Cantidad: {{ $detalle->amount }}</td>
                                                        <td>Subtotal: $ {{ $detalle->product->price * $detalle->amount }}
                                                        </td>

                                                    </tr>
                                                    
                                                        
                                                   
                                                @endforeach
                                                @else
                                                <h2>sin producro</h2>
                                            @endif
                                            </tbody>
                                        </table>
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>


                </div>
            </div>
        </div>
    </div>

</div>
