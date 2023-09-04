
<div class="py-3">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <x-alert />
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h2 class="text-lg font-semibold mb-4">Detalles pedidos</h2>
                <div class="overflow-x-auto">
                    <table id="miTabla" class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Clave pedido</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha entrega</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Observaciones</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estatus</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha de orden</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($detallePedidos as $detallePedido)
                            <tr style="background-color: rgb(181, 127, 232)">
                                <td class="px-6 py-4 whitespace-nowrap">{{ $detallePedido->id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $detallePedido->deadline }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $detallePedido->observations }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $detallePedido->status }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $detallePedido->total }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $detallePedido->created_at }}</td>
                            </tr>
                            <!-- Agrega una fila para los detalles de la orden -->
                            <tr>
                                <td colspan="6">
                                    <!-- Agrega una tabla para mostrar los detalles de la orden actual -->
                                    <table class="table-auto w-full text-sm">
                                        <tbody>
                                            <!-- Itera sobre los detalles de la orden actual -->
                                            @foreach($detallePedido->detalles as $detalle)
                                            <tr> 
                                                <td class="px-2 py-1 whitespace-nowrap">&nbsp&nbsp&nbsp</td>
                                                <td class="px-2 py-1 whitespace-nowrap">&nbsp&nbsp&nbsp</td>
                                                <td class="px-2 py-1 whitespace-nowrap">{{ $detalle->product->descripcion }}</td>
                                                <td class="px-2 py-1 whitespace-nowrap">Precio:{{ $detalle->product->price }}</td>
                                                <td class="px-2 py-1 whitespace-nowrap">Cantidad:{{ $detalle->amount }}</td>
                                                <!-- Agrega más columnas según tus necesidades -->
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <!-- Fin de la fila de detalles de la orden -->
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
