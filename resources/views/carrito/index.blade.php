<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-purple-800 dark:text-gray-200 leading-tight">
            {{ __('Agregar productos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-alert />
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <select id="filtroCategoria">
                <option value="0">Categorías</option>
                @foreach ($categorias as $categoria)
                    <option value="{{ $categoria->id }}">{{ $categoria->name }}</option>
                @endforeach
            </select>
            <select id="filtroMarca">
                <option value="0">Todas las Marcas</option>
                @foreach ($marcas as $marca)
                    <option value="{{ $marca->id }}">{{ $marca->name }}</option>
                @endforeach
            </select>
            
            <select id="filtroGramaje">
                <option value="0">Todos los Gramajes</option>
                @foreach ($gramajes as $gramaje)
                    <option value="{{ $gramaje->id }}">{{ $gramaje->name }}</option>
                @endforeach
            </select>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6" >
                {{-- <h3 class="text-lg font-semibold mb-4">Productos en el producto</h3> --}}
                
                <!-- Lista de productos en el carrito -->
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    @foreach ($productos as $producto)
                        <div class="bg-white p-4 border border-gray-300 shadow-sm rounded-lg producto" data-categoria="{{ $producto->category_id }}" data-marca="{{ $producto->brand_id }}" data-gramaje="{{ $producto->grammage_id }}">
                            <h4 class="text-lg font-semibold mb-2">{{ $producto->descripcion }}</h4>
                            <form action="" method="POST">
                                @csrf
                                </form>
                            <p>Gramaje: {{ $producto->grammage->name }}</p>
                            <p>Presentación: {{ $producto->presentation->name }}</p>
                            <p>Marca: {{ $producto->brand->name }}</p>
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
                </div>
            </div>
        </div>
    </div>
    <script>
// Obtén referencias a los selectores de marca, gramaje y categoría
var filtroMarcaSelect = document.getElementById('filtroMarca');
var filtroGramajeSelect = document.getElementById('filtroGramaje');
var filtroCategoriaSelect = document.getElementById('filtroCategoria');

// Agrega eventos change a los selectores
filtroMarcaSelect.addEventListener('change', filtrarProductos);
filtroGramajeSelect.addEventListener('change', filtrarProductos);
filtroCategoriaSelect.addEventListener('change', filtrarProductos);

// Función para filtrar los productos
function filtrarProductos() {
    var marcaSeleccionada = filtroMarcaSelect.value;
    var gramajeSeleccionado = filtroGramajeSelect.value;
    var categoriaSeleccionada = filtroCategoriaSelect.value;

    var productos = document.getElementsByClassName('producto');

    for (var i = 0; i < productos.length; i++) {
        var producto = productos[i];
        var marcaProducto = producto.getAttribute('data-marca');
        var gramajeProducto = producto.getAttribute('data-gramaje');
        var categoriaProducto = producto.getAttribute('data-categoria');

        var mostrarProducto = true;

        if (marcaSeleccionada !== '0' && marcaSeleccionada !== marcaProducto) {
            mostrarProducto = false;
        }

        if (gramajeSeleccionado !== '0' && gramajeSeleccionado !== gramajeProducto) {
            mostrarProducto = false;
        }

        if (categoriaSeleccionada !== '0' && categoriaSeleccionada !== categoriaProducto) {
            mostrarProducto = false;
        }

        if (mostrarProducto) {
            producto.style.display = 'block';
        } else {
            producto.style.display = 'none';
        }
    }
}


   </script>
</x-app-layout>
