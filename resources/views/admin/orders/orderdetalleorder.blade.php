
<div class="container">
    <x-alert />
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-1 bg-white border-b border-gray-200">
            <div class="table-container" style="max-height: 420px; overflow-y: auto;">
                <div class="table-responsive">
                    <table id="miTabla" class="custom-table" style="font-size: 10px">
                        <thead>
                            <tr>
                                <!-- Encabezados de la tabla -->
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
                                <!-- Fila de datos del pedido -->
                                <tr class="morada collapsed" data-bs-toggle="collapse" data-bs-target="#detalle{{ $detallePedido->id }}" aria-expanded="false" aria-controls="#detalle{{ $detallePedido->id }}">
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $detallePedido->id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $detallePedido->deadline }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $detallePedido->observations }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if ($detallePedido->status === 1)
                                            Creado
                                        @else
                                            Surtido
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">$ {{ number_format($detallePedido->total, 2) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $detallePedido->created_at }}</td>
                                </tr>
                                <!-- Fin de la fila de datos del pedido -->
                                
                                <!-- Filas de detalles del pedido (ocultas por defecto) -->
                                @foreach($detallePedido->detalles as $detalle)
                                    <tr class="blanca collapsed" id="detalle{{ $detallePedido->id }}">
                                        <td class="px-6 py-4 whitespace-nowrap"></td>
                                        <td class="px-6 py-4 whitespace-nowrap"></td>
                                        <td class="px-6 py-4 whitespace-nowrap"></td>
                                        <!-- Datos de los detalles del pedido -->
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $detalle->product->descripcion }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">Precio: ${{ number_format($detalle->product->price, 2) }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">Cantidad: {{ $detalle->amount }}</td>
                                    </tr>
                                @endforeach
                                <!-- Fin de las filas de detalles del pedido -->
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
