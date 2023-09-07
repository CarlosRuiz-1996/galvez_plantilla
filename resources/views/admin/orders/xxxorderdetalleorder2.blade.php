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
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Clave pedido</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Fecha entrega</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Observaciones</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Estatus</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Total</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Fecha de orden</th>
                            </tr>
                        </thead>
                        <tbody x-data="{ openRow: null }">
                            @foreach ($detallePedidos as $detallePedido)
                                <!-- Fila de datos del pedido -->
                                <tr class="morada cursor-pointer"
                                    @click="openRow === {{ $detallePedido->id }} ? openRow = null : openRow = {{ $detallePedido->id }}">
                                    <td class="px-6 py-4 whitespace-nowrap bg-orange-200">{{ $detallePedido->id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap bg-orange-200">{{ $detallePedido->deadline }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap bg-orange-200">
                                        {{ $detallePedido->observations }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap bg-orange-200">
                                        @if ($detallePedido->status === 1)
                                            Creado
                                        @else
                                            Surtido
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap bg-orange-200">$
                                        {{ number_format($detallePedido->total, 2) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap bg-orange-200">
                                        {{ $detallePedido->created_at }}</td>
                                </tr>
                                <!-- Fin de la fila de datos del pedido -->

                                <!-- Filas de detalles del pedido (colapsadas por defecto) -->


                                @foreach ($detallePedido->detalles as $detalle)
                                    <tr x-show.transition="openRow === {{ $detallePedido->id }}" x-cloak>
                                        <td class="px-6 py-4 whitespace-nowrap">Producto:</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $detalle->product->descripcion }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">Precio:</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            ${{ number_format($detalle->product->price, 2) }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">Cantidad:{{ $detalle->amount }}</td>
                                        <td></td>
                                        <td></td>
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


<div class="container">
    <x-alert />
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-1 bg-white border-b border-gray-200">
            <div class="table-container" style="max-height: 420px; overflow-y: auto;">
                <div class="table-responsive">
                    <table id="" class="custom-table" style="font-size: 10px">
                        <thead>
                            <tr>
                                <!-- Encabezados de la tabla -->
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Clave pedido</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Fecha entrega</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Observaciones</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Estatus</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Total</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Fecha de orden</th>
                            </tr>
                        </thead>
                        <tbody x-data="{ openRow: null }">
                            @foreach ($detallePedidos as $detallePedido)
                                <!-- Fila de datos del pedido -->
                                <tr class="morada cursor-pointer"
                                    @click="openRow === {{ $detallePedido->id }} ? openRow = null : openRow = {{ $detallePedido->id }}">
                                    <td class="px-6 py-4 whitespace-nowrap bg-orange-200">{{ $detallePedido->id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap bg-orange-200">{{ $detallePedido->deadline }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap bg-orange-200">
                                        {{ $detallePedido->observations }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap bg-orange-200">
                                        @if ($detallePedido->status === 1)
                                            Creado
                                        @else
                                            Surtido
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap bg-orange-200">$
                                        {{ number_format($detallePedido->total, 2) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap bg-orange-200">
                                        {{ $detallePedido->created_at }}</td>
                                </tr>
                                <!-- Fin de la fila de datos del pedido -->

                                <!-- Filas de detalles del pedido (colapsadas por defecto) -->


                                @foreach ($detallePedido->detalles as $detalle)
                                    <tr x-show.transition="openRow === {{ $detallePedido->id }}" x-cloak>
                                        <td class="px-6 py-4 whitespace-nowrap">Producto:</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $detalle->product->descripcion }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">Precio:</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            ${{ number_format($detalle->product->price, 2) }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">Cantidad:{{ $detalle->amount }}</td>
                                        {{-- <td></td>
                                        <td></td> --}}
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

