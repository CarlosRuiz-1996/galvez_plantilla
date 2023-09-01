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
                <form action="" method="POST">
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
        </div>
    </div>



</x-app-layout>
