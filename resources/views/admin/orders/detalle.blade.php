    <table class="w-full divide-y divide-gray-400">
        <thead class="bg-orange-100">
            <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    producto
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    marca
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    presentación
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    costo
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    cantidad
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    subtotal
                </th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @php
                $total = 0; // Inicializa el total
            @endphp

            @foreach ($detallePedidos as $detalle)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        {{ $detalle->product->descripcion ?? 'N/A' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        {{ $detalle->product->brand->name ?? 'N/A' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        {{ $detalle->product->presentation->name ?? 'N/A' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                       ${{ number_format( $detalle->product->total, 2, '.', ',') }}

                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        {{ $detalle->amount }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                         ${{ number_format($detalle->amount * $detalle->product->total, 2, '.', ',') }}

                    </td>
                </tr>

                @php
                    $subtotal = $detalle->product->total * $detalle->amount; // Calcula el subtotal
                    $total += $subtotal; // Suma el subtotal al total
                @endphp
            @endforeach

            <!-- Fila para mostrar el total -->
            <tr>
                <td class="px-6 py-4 whitespace-nowrap font-semibold" colspan="2">
                    Total:
                </td>
                <td class="px-6 py-4 whitespace-nowrap font-semibold">
                   ${{ number_format($total, 2, '.', ',') }}

                </td>
            </tr>
        </tbody>
    </table>
