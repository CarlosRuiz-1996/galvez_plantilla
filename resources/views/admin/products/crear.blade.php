<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-purple-800 dark:text-gray-200 leading-tight">
            @if (isset($producto) && is_object($producto))
                {{ __('Editar producto') }}
            @else
                {{ __('Crear producto') }}
            @endif
        </h2>
    </x-slot>

    <div class="">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <x-alert />
            <br>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                    <form
                        action="{{ isset($producto) ? route('admin.products.update', ['id' => $producto->id]) : route('admin.products.guardar') }}"
                        method="post">
                        @csrf
                        @if (isset($producto) && is_object($producto))
                            <input type="text" hidden name="id" value="{{ $producto->id ?? '' }}" />
                        @endif

                        <div>
                            <label for="descripcion"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Descripción</label>
                            <input type="text" name="descripcion" id="descripcion"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                value="{{ $producto->descripcion ?? '' }}">
                            <x-input-error :messages="$errors->get('descripcion')" class="mt-2" />
                        </div>
                        <div>
                            <label for="categoria"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Categoría</label>
                            <select name="categoria" id="categoria"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                <option value="" disabled selected>Select a category</option>
                                @foreach ($categorias as $categoria)
                                    <option value="{{ $categoria->id }}"
                                        {{ isset($producto) && $producto->categoria_id == $categoria->id ? 'selected' : '' }}>
                                        {{ $categoria->name }}</option>
                                @endforeach
                            </select>
                        </div>                      

                        <div>
                            <label for="grammage_id"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Grammage</label>
                            <select name="grammage_id" id="grammage_id"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                <option value="" disabled selected>Select Grammage</option>
                                @foreach ($grammages as $grammage)
                                    <option value="{{ $grammage->id }}"
                                        {{ isset($producto) && $producto->grammage_id == $grammage->id ? 'selected' : '' }}>
                                        {{ $grammage->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('grammage_id')" class="mt-2" />
                        </div>


                        <div>
                            <label for="presentation_id"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Presentación</label>
                            <select name="presentation_id" id="presentation_id"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                <option value="" disabled selected>Selecciona la Presentación</option>
                                @foreach ($presentations as $presentation)
                                    <option value="{{ $presentation->id }}"
                                        {{ isset($producto) && $producto->presentation_id == $presentation->id ? 'selected' : '' }}>
                                        {{ $presentation->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('presentation_id')" class="mt-2" />
                        </div>


                        <div>
                            <label for="brand_id"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Brand ID</label>
                            <select name="brand_id" id="brand_id"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                <option value="" disabled selected>Select a brand</option>
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}"
                                        {{ isset($producto) && $producto->brand_id == $brand->id ? 'selected' : '' }}>
                                        {{ $brand->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('brand_id')" class="mt-2" />
                        </div>


                        <div>
                            <label for="price"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Price</label>
                            <input type="number" name="price" id="price" onchange="calcularTotal()"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                value="{{ $producto->price ?? '' }}">
                            <x-input-error :messages="$errors->get('price')" class="mt-2" />
                        </div>

                        <div>
                            <label for="iva_id"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">IVA</label>
                            <select name="iva_id" id="iva_id" onchange="calcularTotal()"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                <option value="" disabled selected>Select IVA</option>
                                @foreach ($iva as $iv)
                                    <option value="{{ $iv->id }}"
                                        {{ isset($producto) && $producto->iva_id == $iv->id ? 'selected' : '' }}>
                                        {{ $iv->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('iva_id')" class="mt-2" />
                        </div>

                        <div>
                            <label for="ieps_id"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">IEPS</label>
                            <select name="ieps_id" id="ieps_id" onchange="calcularTotal()"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                <option value="" disabled selected>Select IEPS</option>
                                @foreach ($ieps as $iep)
                                    <option value="{{ $iep->id }}"
                                        {{ isset($producto) && $producto->ieps_id == $iep->id ? 'selected' : '' }}>
                                        {{ $iep->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('ieps_id')" class="mt-2" />
                        </div>


                        <div>
                            <label for="total"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Total</label>
                            <input type="text" name="total" id="total"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                value="{{ $producto->total ?? '' }}" readonly>
                            <x-input-error :messages="$errors->get('total')" class="mt-2" />
                        </div>

                        <div>
                            <label for="stock"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Stock</label>
                            <input type="number" name="stock" id="stock"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                value="{{ $producto->stock ?? '' }}" step="10">
                            <x-input-error :messages="$errors->get('stock')" class="mt-2" />
                        </div>


                        <div class="mt-6">
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-600 active:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 dark:bg-gray-600 dark:border-gray-600 dark:text-white dark:hover:bg-gray-700 dark:focus:ring-gray-700">
                                Guardar producto
                            </button>

                            <a href="{{ route('admin.products') }}" type="button"
                                class="inline-flex items-center px-4 py-2 bg-red-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-600 active:bg-red-700 focus:outline-none focus:border-red-700 focus:ring focus:ring-red-200 dark:bg-gray-600 dark:border-gray-600 dark:text-white dark:hover:bg-gray-700 dark:focus:ring-gray-700">
                                Cancelar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function calcularTotal() {
            var price = parseFloat(document.getElementById('price').value);
            var ivaAmount = parseFloat(document.getElementById('iva_id').options[document.getElementById('iva_id')
                .selectedIndex].text) || 0;
            var iepsAmount = parseFloat(document.getElementById('ieps_id').options[document.getElementById('ieps_id')
                .selectedIndex].text) || 0;

            var total = price + (price * (ivaAmount / 100)) + (price * (iepsAmount / 100));

            document.getElementById('total').value = total.toFixed(2);
        }
    </script>
    <script>
        $(document).ready(function() {
        // Función para buscar la categoría
        function buscarCategoria() {
            var descripcion = document.getElementById('descripcion').value;
    
            // Realiza una solicitud AJAX para buscar la categoría
            $.ajax({
                type: 'POST',
                url: '{{ route('productos.buscar-categoria') }}',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'descripcion': descripcion
                },
                success: function(data) {
                    var categoriaNombre = data.categoria.name;

// Elimina la selección de la opción predeterminada
$('#categoria option:selected').removeAttr('selected');

// Muestra el contenido de todas las opciones en el select
$('#categoria option').each(function() {
});

// Verifica si la opción con el valor de categoriaNombre existe en el select
var option = $('#categoria option').filter(function() {
    return $(this).val()==data.categoria.id
});

if (option.length > 0) {
    option.prop('selected', true);
}

                                    }
        });
        }
    
        // Escucha el evento keyup en el campo de descripción
        $('#descripcion').on('keyup', function() {
            buscarCategoria();
        });
    
        // Llama a buscarCategoria al cargar la página si el campo de descripción ya tiene valor
        $(document).ready(function() {
            if ($('#descripcion').val() !== '') {
                buscarCategoria();
            }
        });
    });
    </script>
</x-app-layout>
