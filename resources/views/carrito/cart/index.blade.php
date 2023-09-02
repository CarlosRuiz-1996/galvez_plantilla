<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-purple-800 dark:text-gray-200 leading-tight">
            {{ __('Productos agregados') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-alert />

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{route('cart.generarPedido')}}" method="POST">
                    @csrf
                    <div class="grid grid-cols-9 gap-4">
                        @if ($cart)
                            <div class="col-span-7">

                                @foreach ($cart as $productId => $productData)
                                    <div class="mb-4 p-4 border border-gray-200 rounded-lg flex items-center">
                                        <div class="grid grid-cols-5 gap-4">
                                            <div class="col-span-2 flex items-center">
                                                {{-- <img src="{{ asset('img/producto.png') }}"
                                                alt="{{ $productData['product']['descripcion'] }}"
                                                class="w-16 h-16 object-cover rounded-full"> --}}
                                                <div class="ml-4">
                                                    <h2 class="text-lg font-semibold">
                                                        {{ $productData['product']['descripcion'] }}</h2>
                                                    <p class="text-gray-600">Marca:
                                                        {{ $productData['product']['brand']['name'] }}</p>
                                                    <p class="text-gray-600">Presentación:
                                                        {{ $productData['product']['presentation']['name'] }}</p>

                                                    <p class="text-gray-600">Precio:
                                                        ${{ $productData['product']['price'] }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div
                                                class="col-span-3 flex items-center justify-between ">
                                                <!-- Botones de incrementar y disminuir cantidad -->
                                                <div class="grid grid-cols-3 gap-4">
                                                    <div class="col-span-1 flex items-center space-x-4 ml-4">
                                                        <a type="button"
                                                            class="text-gray-500 font-semibold text-xl focus:outline-none"
                                                            href="{{ route('cart.update', ['accion' => 'decrease', 'id' => $productId]) }}">-</a>
                                                        <input type="number" id="quantity_{{ $productId }}"
                                                            name="product_quantities[{{ $productId }}]"
                                                            class="w-16 h-10 text-center rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                                            value="{{ $productData['quantity'] }}" required>
                                                        <a type="button"
                                                            class="text-gray-500 font-semibold text-xl focus:outline-none"
                                                            href="{{ route('cart.update', ['accion' => 'increase', 'id' => $productId]) }}">+</a>
                                                    </div>

                                                    <!-- Información de impuestos y subtotal -->
                                                    <div class="col-span-1 flex items-center ml-12">
                                                        <div class="space-y-2">
                                                            <p class="text-gray-600 font-semibold">Impuestos</p>
                                                            <p class="text-gray-600 font-semibold">(IVA):
                                                                {{ $productData['product']['iva']['name'] }}%</p>
                                                            <p class="text-gray-600 font-semibold">(IEPS):
                                                                ${{ $productData['product']['ieps']['name'] }}%</p>
                                                            <hr class="border-t border-gray-300">
                                                            <p class="text-gray-600 font-semibold">Subtotal:
                                                                ${{ $productData['quantity'] * $productData['product']['total'] }}
                                                            </p>
                                                        </div>
                                                    </div>

                                                    <!-- Botón para eliminar -->
                                                    <div class="col-span-1 ml-12 py-16">
                                                        <a href="{{ route('cart.removeProduct', ['productId' => $productId]) }}"
                                                            class="text-red-600 hover:text-red-800"
                                                            onclick="return confirm('¿Estás seguro de eliminar este producto del carrito?');">
                                                            Eliminar
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>



                                    </div>
                                @endforeach

                            </div>
                            <div class="text-end col-span-2">
                                <div class="mb-4 p-4 border border-gray-200 rounded-lg">
                                    <p class="text-xl font-semibold mb-4">Total: ${{ session('cartTotal') }}</p>
                                    <p>Fecha de entrega deseada</p>
                                    <input type="date" name="entrega" class="block w-full p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-md focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    

                                    <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Comentarios</label>
                                    <textarea id="message" rows="2" name="message"
                                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                     placeholder="Algun comentario sobre la entrega..."></textarea>
                                    
                                    <button type="submit"
                                        class="text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-semibold rounded-lg text-sm px-5 py-2.5 mt-4 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900 focus:outline-none">
                                        Realizar Pedido
                                    </button>
                                </div>
                            </div>
                        @else
                            <div class="col-span-9">
                                <div class="flex items-center p-4 mb-4 text-sm text-yellow-800 border border-yellow-300 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-300 dark:border-yellow-800"
                                    role="alert">
                                    <svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                                    </svg>
                                    <span class="sr-only">Info</span>
                                    <div class="pb-0">
                                        <span class="font-medium">Aviso!</span> Sin prodcutos.
                                    </div>
                                </div>
                            </div>
                        @endif
                </form>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                ID
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Hospital ID
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Deadline
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Observations
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Total
                            </th>
                            <th scope="col" class="px-6 py-3">
                                <span class="sr-only">Detalles</span>
                            </th>
                        </tr>
                    </thead>                    
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($pedidos as $pedido)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $pedido->id }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $pedido->hospital->name ?? 'N/A' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $pedido->deadline }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $pedido->observations }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if ($pedido->status == 1)
                                        Pendiente
                                    @else
                                        Entregado
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $pedido->total }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a type="button" class="text-orange-700 detalles-btn" data-id="{{ $pedido->id }}">
                                        Detalles
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                
            </div>

            <div class="mt-4">
                {{ $pedidos->appends(request()->except('page'))->links() }}
            </div>
        </div>
    </div>
    <div id="detalleModal" class="modal hidden fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
        <div class="modal-content bg-white rounded-lg p-6">
            <!-- Aquí se cargarán los detalles del pedido mediante AJAX -->
        </div>
    </div>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const detallesButtons = document.querySelectorAll('.detalles-btn');
        const modal = document.getElementById('detalleModal');
        const modalContent = modal.querySelector('.modal-content');
    
        detallesButtons.forEach(button => {
            button.addEventListener('click', function (event) {
                event.preventDefault(); // Evita el comportamiento predeterminado del enlace/button
                
                const pedidoId = button.getAttribute('data-id');
                
                // Lógica para cargar los detalles del pedido en el modal (puedes usar AJAX)
                cargarDetallesPedido(pedidoId);
                
                // Muestra el modal
                modal.classList.remove('hidden');
            });
        });
    
        // Cierra el modal al hacer clic fuera de él
        modal.addEventListener('click', function (event) {
            if (event.target === modal) {
                modal.classList.add('hidden');
            }
        });
    
        function cargarDetallesPedido(pedidoId) {
            // Utiliza AJAX para cargar los detalles del pedido en el modalContent
            // Por ejemplo:
            modalContent.innerHTML = '<p>Cargando detalles...</p>';
            // Realiza la solicitud AJAX para cargar los detalles del pedido
            $.ajax({
                url: '/admin/orders/' + pedidoId + '/detalle',
                method: 'GET',
                success: function(response) {
                    console.log(response);
                    modalContent.innerHTML = response;
                },
                error: function() {
                    modalContent.innerHTML = '<p>Error al cargar los detalles.</p>';
                }
            });
        }
    });
    </script>
    



</x-app-layout>
