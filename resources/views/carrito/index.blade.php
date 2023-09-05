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
                <div class="slick-carousel">

                    @foreach ($productos as $producto)
                        {{-- <div class="bg-white mr-4 p-4 border border-gray-300 shadow-sm rounded-lg producto"
                            data-categoria="{{ $producto->category_id }}" data-marca="{{ $producto->brand_id }}"
                            data-gramaje="{{ $producto->grammage_id }}">
                            <h4 class="text-lg font-semibold mb-2">{{ $producto->descripcion }}</h4>
                            <form action="" method="POST">
                                @csrf
                            </form>
                            <p>Gramaje: {{ $producto->grammage->name }}</p>
                            <img class="object-none object-left-top bg-yellow-300 w-24 h-24 ..." src="...">

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
                        </div> --}}
                        <div class="w-full max-w-sm mr-4 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 h-[350px] producto"
                            data-categoria="{{ $producto->category_id }}" data-marca="{{ $producto->brand_id }}"
                            data-gramaje="{{ $producto->grammage_id }}">


                            <button data-modal-toggle="defaultModal" data-product-id="{{ $producto->id }}"
                                data-product-price="${{ $producto->price }}"
                                data-product-description="{{ $producto->descripcion }}"
                                data-product-brand="{{ $producto->brand->name }}"
                                data-product-grammage="{{ $producto->grammage->name }}"
                                data-product-presentation="{{ $producto->presentation->name }}"

                                data-product-image="{{ asset('img/products/' . $producto->image_path) }}"
                                type="button">
                                <img class="p-8 rounded-t-lg h-40"
                                    src="{{ asset('img/products/' . $producto->image_path) }}" alt="product image" />
                            </button>
                            <div class="px-5 pb-5">

                                <button data-modal-toggle="defaultModal" ddata-product-id="{{ $producto->id }}"
                                    data-product-price="${{ $producto->price }}"
                                    data-product-description="{{ $producto->descripcion }}"
                                    data-product-brand="{{ $producto->brand->name }}"
                                    data-product-grammage="{{ $producto->grammage->name }}"
                                    data-product-presentation="{{ $producto->presentation->name }}"
                                    data-product-image="{{ asset('img/products/' . $producto->image_path) }}"
                                    type="button">
                                    <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">
                                        {{ $producto->descripcion }}
                                    </h5>
                                </button>

                                <div class="flex items-center mt-2.5 mb-5">
                                    <svg class="w-4 h-4 text-yellow-300 mr-1" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                        <path
                                            d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                    </svg>
                                    <svg class="w-4 h-4 text-yellow-300 mr-1" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                        <path
                                            d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                    </svg>
                                    <svg class="w-4 h-4 text-yellow-300 mr-1" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                        <path
                                            d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                    </svg>
                                    <svg class="w-4 h-4 text-yellow-300 mr-1" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                        <path
                                            d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                    </svg>
                                    <svg class="w-4 h-4 text-gray-200 dark:text-gray-600" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                        <path
                                            d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                    </svg>
                                    <span
                                        class="bg-blue-100 text-blue-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800 ml-3">5.0</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-3xl font-bold text-gray-900 dark:text-white">
                                        ${{ $producto->price }}
                                    </span>
                                    {{-- <a href="#"
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Add
                                    to cart</a> --}}
                                    <form action="{{ route('cart.add', $producto->id) }}" method="POST">
                                        @csrf
                                        <input class="mt-1 block rounded-md" type="hidden" name="quantity"
                                            value="1" min="1" hidden>
                                        @if (!auth()->user()->hospitals->isEmpty())
                                            <button
                                                class="focus:outline-none text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 mt-4 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900"
                                                type="submit">Agregar a producto</button>
                                        @else
                                            <div class="mt-3 p-2 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                                                role="alert">
                                                <span class="font-medium">Alerta!</span> Indica a que hospital
                                                perteneces para
                                                poder hacer compras.
                                            </div>
                                        @endif
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <hr>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form id="miFormulario" action="{{ route('cart.generarPedido') }}" method="POST">
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
                                    <input type="date" name="entrega" required
                                        class="block w-full p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-md focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">


                                    <label for="message"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Comentarios</label>
                                    <textarea id="message" rows="2" name="message" required
                                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="Algun comentario sobre la entrega..."></textarea>

                                    {{-- <button type="submit" id="showAlert"
                                        class="text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-semibold rounded-lg text-sm px-5 py-2.5 mt-4 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900 focus:outline-none">
                                        Realizar Pedido
                                    </button> --}}
                                    <button type="submit" id="confirmPedido"
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



    <!-- Main modal -->
    <div id="defaultModal" tabindex="-1" aria-hidden="true"
        class="fixed inset-0 flex items-center justify-center z-50 hidden">
        <div class="fixed inset-0 bg-black opacity-50"></div>
        <div class="relative w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Detalles del producto
                    </h3>

                </div>
                <!-- Modal body -->
                <div class="p-6 space-y-6">
                    <!-- Close button -->
                    <button type="button"
                        class="absolute top-2 right-2 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300"
                        data-modal-hide="defaultModal">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                    <!-- Product details -->
                    <div class="text-center">
                        <img src="" alt="Product Image" id="productImage" class="mx-auto max-h-40">
                        <h3 class="mt-4 text-xl font-semibold text-gray-900 dark:text-white" id="productName"></h3>
                        <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400" id="productDescription">
                        </p>
                        <p class="text-base font-semibold text-gray-900 dark:text-white" id="productPrice">$</p>
                        <p class="text-base font-semibold text-gray-900 dark:text-white" id="productBrand"></p>
                        <p class="text-base font-semibold text-gray-900 dark:text-white" id="productGrammage"></p>
                        <p class="text-base font-semibold text-gray-900 dark:text-white" id="productPresentation"></p>

                    </div>
                </div>


            </div>
        </div>
    </div>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const openModalButtons = document.querySelectorAll("[data-modal-toggle='defaultModal']");
            const closeModalButton = document.querySelector("[data-modal-hide='defaultModal']");
            const modal = document.getElementById("defaultModal");
            const productNameElement = document.getElementById("productName");
            const productDescriptionElement = document.getElementById("productDescription");
            const productImageElement = document.getElementById("productImage");
            const productPriceElement = document.getElementById("productPrice");
            const productBrandElement = document.getElementById("productBrand");
            const productGrammageElement = document.getElementById("productGrammage");
            const productPresentationElement = document.getElementById("productPresentation");

            // Función para abrir el modal y mostrar detalles del producto
            function openModal(productPrice, productDescription, productImage, productBrand,productGrammage, productPresentation) {
                modal.classList.remove("hidden");
                productPriceElement.textContent = productPrice;
                productDescriptionElement.textContent = productDescription;
                productImageElement.src = productImage;
                productBrandElement.textContent = productBrand;
                productGrammageElement.textContent = productGrammage;
                productPresentationElement.textContent = productPresentation;

            }

            // Función para cerrar el modal
            function closeModal() {
                modal.classList.add("hidden");
            }

            // Agrega eventos de clic para abrir y cerrar el modal
            openModalButtons.forEach(button => {
                button.addEventListener("click", function() {
                    const productPrice = button.getAttribute("data-product-price");
                    const productDescription = button.getAttribute("data-product-description");
                    const productImage = button.getAttribute("data-product-image");
                    const productBrand = button.getAttribute("data-product-brand");
                    const productPresentation = button.getAttribute("data-product-presentation");
                    const productGrammage = button.getAttribute("data-product-grammage");

                    openModal(productPrice, productDescription, productImage, productBrand,productPresentation , productGrammage);
                });
            });

            closeModalButton.addEventListener("click", closeModal);
        });
        //alert confirmacion
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('confirmPedido').addEventListener('click', function(e) {
                e.preventDefault(); // Previene el envío del formulario por defecto
                if (this.checkValidity()) {
                    Swal.fire({
                        title: '¡Confirmación!',
                        text: '¿Estás seguro de que deseas realizar el pedido?',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonText: 'Sí, realizar pedido',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // El usuario confirmó, enviar el formulario
                            // document.querySelector('form').submit();
                            document.getElementById('miFormulario').submit();
                            Swal.fire(
                                'Pedido realizado!',
                                'Pronto recibira su pedido.',
                                'success'
                            )
                        }
                    });
                }
            });
        });

        //filtros
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
