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
                
                <!-- Lista de productos en el carrito -->
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    @foreach ($productos as $producto)
                        <div class="bg-white p-4 border border-gray-300 shadow-sm rounded-lg">
                            <h4 class="text-lg font-semibold mb-2">{{ $producto->descripcion }}</h4>
                            <form action="" method="POST">
                                @csrf
                                </form>
                            <p>Gramaje ID: {{ $producto->grammage->name }}</p>
                            <p>Presentation ID: {{ $producto->presentation->name }}</p>
                            <p>Brand ID: {{ $producto->brand->name }}</p>
                            <p>Precio: {{ $producto->price }}</p>
                            <div class="mt-2">
                                <label for="cantidad" class="block font-medium text-gray-700">Cantidad:</label>
                                <input type="number" id="cantidad" name="cantidad" class="form-input mt-1 w-full">
                            </div>
                            <button type="submit" class="focus:outline-none text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 mt-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">Agregar</button>
  
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
