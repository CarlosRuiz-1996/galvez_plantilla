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
