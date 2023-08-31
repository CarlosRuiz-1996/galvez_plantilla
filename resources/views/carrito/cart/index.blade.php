<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-purple-800 dark:text-gray-200 leading-tight">
            {{ __('Carrito') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">Productos en el carrito</h3>
                <form action="{{ route('cart.update') }}" method="POST">
                    @csrf
                    @foreach ($cart as $productId => $product)
                        <div class="cart-item">
                            <h2>{{ $product->descripcion }}</h2>
                            <p>precio: ${{ $product->price }}</p>
                            <div class="mt-2">
                                <label for="quantity{{ $productId }}" class="block font-medium text-gray-700">Cantidad:</label>
                                <input type="number" id="quantity_{{ $productId }}" name="quantity[{{ $productId }}]"
                                class="form-input mt-1 w-full" value="{{ $product['quantity'] }}" required>
                            </div>
                        </div>
                    @endforeach
                    <button type="submit" class="focus:outline-none text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 mt-4 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">Actualizar Cantidades</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
