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
                <div class="flex space-x-4"> <!-- Contenedor flex para mostrar los selectores en la misma fila -->
                    <select id="filtroCategoria"
                        class="block appearance-none bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                        <option value="0">Categorías</option>
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id }}">{{ $categoria->name }}</option>
                        @endforeach
                    </select>

                    <select id="filtroMarca"
                        class="block appearance-none bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                        <option value="0">Todas las Marcas</option>
                        @foreach ($marcas as $marca)
                            <option value="{{ $marca->id }}">{{ $marca->name }}</option>
                        @endforeach
                    </select>

                    <select id="filtroGramaje"
                        class="block appearance-none bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                        <option value="0">Todos los Gramajes</option>
                        @foreach ($gramajes as $gramaje)
                            <option value="{{ $gramaje->id }}">{{ $gramaje->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>


            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <!-- Carrusel de productos -->
                <div class="slick-carousel" >
                    @foreach ($productos as $producto)
                        <div class="bg-white mr-4 p-4 border border-gray-300 shadow-sm rounded-lg producto"
                            data-categoria="{{ $producto->category_id }}" data-marca="{{ $producto->brand_id }}"
                            data-gramaje="{{ $producto->grammage_id }}">
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
                                @if (!auth()->user()->hospitals->isEmpty())
                                    <button
                                        class="focus:outline-none text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 mt-4 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900"
                                        type="submit">Agregar a producto</button>
                                @else
                                    <div class="mt-3 p-2 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                                        role="alert">
                                        <span class="font-medium">Alerta!</span> Indica a que hospital perteneces para
                                        poder hacer compras.
                                    </div>
                                @endif
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
            <hr>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('cart.generarPedido') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-9 gap-4">
                        @if ($cart)
                            <div class="col-span-7">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-100 ">
                                        <th scope="col" class="px-6 py-3">Producto</th>
                                        <th scope="col" class="px-4 ">Marca</th>
                                        <th scope="col" class="px-6 ">Presentación</th>
                                        <th scope="col" class="px-4 ">Precio</th>
                                        <th scope="col" class="px-4 ">Iva</th>
                                        <th scope="col" class="px-4 ">Ipes</th>
                                        <th scope="col" class="px-4 ">Cantidad</th>
                                        <th scope="col" class="px-4 ">Subtotal</th>
                                        <th scope="col" class="px-2 ">Eliminar</th>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach ($cart as $productId => $productData)
                                            <tr
                                                class="table-row bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                                <td class="px-6 py-4"> {{ $productData['product']['descripcion'] }}
                                                </td>
                                                <td> {{ $productData['product']['brand']['name'] }}</td>
                                                <td class="px-6 ">
                                                    {{ $productData['product']['presentation']['name'] }}</td>
                                                <td class="px-6 "> ${{ $productData['product']['price'] }}</td>
                                                <td class="px-6 "> {{ $productData['product']['iva']['name'] }}%</td>
                                                <td class="px-6 "> ${{ $productData['product']['ieps']['name'] }}%
                                                </td>
                                                <td>
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
                                                </td>
                                                <td class="px-6 ">
                                                    ${{ $productData['quantity'] * $productData['product']['total'] }}
                                                </td>

                                                <td> <a href="{{ route('cart.removeProduct', ['productId' => $productId]) }}"
                                                        class="text-red-600 hover:text-red-800"
                                                        onclick="return confirm('¿Estás seguro de eliminar este producto del carrito?');">
                                                        Eliminar
                                                    </a>
                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>



                            </div>
                            <div class="text-end col-span-2">
                                <div class="mb-4 p-4 border border-gray-200 rounded-lg">
                                    <p class="text-xl font-semibold mb-4">Total: ${{ session('cartTotal') }}</p>
                                    <p>Fecha de entrega deseada</p>
                                    <input type="date" name="entrega"
                                        class="block w-full p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-md focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">


                                    <label for="message"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Comentarios</label>
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

        $(document).ready(function() {
            $('.slick-carousel').slick({
                slidesToShow: 4, // Número de productos que se muestran en cada slide
                slidesToScroll: 1, // Número de productos que se desplazan en cada cambio de slide
                autoplay: false, // Reproducción automática del carrusel
                // autoplaySpeed: 3000, // Velocidad de reproducción automática en milisegundos
                responsive: [{
                        breakpoint: 768, // Cambios en la configuración en pantallas más pequeñas
                        settings: {
                            slidesToShow: 2,
                        }
                    },
                    {
                        breakpoint: 576, // Cambios en la configuración en pantallas aún más pequeñas
                        settings: {
                            slidesToShow: 1,
                        }
                    }
                ],
                prevArrow: '<button class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded" aria-label="Anterior">Anterior</button>',
                nextArrow: '<button class="mt-0 bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded" aria-label="Siguiente">Siguiente</button>'
            });
        });
    </script>
</x-app-layout>
