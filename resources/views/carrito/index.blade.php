<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-purple-800 dark:text-gray-200 leading-tight">
            {{ __('Agregar productos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-alert />

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                {{-- <h3 class="text-lg font-semibold mb-4">Productos en el producto</h3> --}}
                
                <!-- Lista de productos en el carrito -->
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
<<<<<<< HEAD
                    <div class="container">
                    <label for="categoria_filter" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Filtrar por categoría:</label>
                    <select id="categoria_filter" class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        <option value="">Todas las categorías</option>
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id }}">{{ $categoria->name }}</option>
                        @endforeach
                    </select>
                </div>
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Descripción</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Gramaje</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Presentación</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Marca</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Precio</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Cantidad</th>
                                <th class="px-6 py-3 bg-gray-50"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($productos as $producto)
                                <tr data-categoria-id="{{ $producto->category_id }}">
                                    <td class="px-6 py-4 whitespace-no-wrap">{{ $producto->descripcion }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap">{{ $producto->grammage->name }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap">{{ $producto->presentation->name }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap">{{ $producto->brand->name }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap">{{ $producto->price }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap">
                                        <form action="{{ route('cart.add', $producto->id) }}" method="POST">
                                            @csrf
                                            <input type="number" name="quantity" value="1" min="1">
                                            <button type="submit" class="text-blue-600 hover:underline">Agregar a carrito</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
=======
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
                            <form action="{{ route('cart.add', $producto->id) }}" method="POST">
                                @csrf
                                <input 
                                class="mt-1 block rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 dark:bg-gray-700 dark:border-gray-600 dark:text-white"

                                type="number" name="quantity" value="1" min="1">
                                @if(!auth()->user()->hospitals->isEmpty())
                                <button 
                                class="focus:outline-none text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 mt-4 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900"
                                type="submit">Agregar a producto</button>
                                    
                                @else
                                
                                <div class="mt-3 p-2 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                                    <span class="font-medium">Alerta!</span> Indica a que hospital perteneces para poder hacer compras.
                                  </div>
                                @endif
                               
                            </form>
                        </div>
                    @endforeach
>>>>>>> c804294e9bdc73fa534a4599a72a17e82d4305c7
                </div>
            </div>
        </div>
    </div>
    <script>
        $('#categoria_filter').on('change', function() {
    var selectedCategoria = $(this).val();
console.log(selectedCategoria);
    $('table tbody tr').each(function() {
        var categoriaId = $(this).data('categoria-id');

        if (selectedCategoria === '' || selectedCategoria == categoriaId) {
            $(this).show();
        } else {
            $(this).hide();
        }
    });
});
    </script>
</x-app-layout>
