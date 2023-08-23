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
                    {{-- <form action="{{ route('producto.guardar') }}" method="POST"> --}}
                    <form action="{{ isset($producto) ? route('producto.update') : route('producto.guardar') }}"
                        method="post">

                        @csrf
                        @if (isset($producto) && is_object($producto))
                            <input type="text" hidden name="id" value="{{ $producto->id ?? '' }}" />
                        @endif
                        <div>
                            <label for="nombre"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nombre del
                                producto</label>
                            <input type="text" name="nombre" id="nombre"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                value="{{ $producto->nombre ?? '' }}">
                            <x-input-error :messages="$errors->get('nombre')" class="mt-2" />

                        </div>
                        <div>

                            <label for="descripcion"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Descripción</label>
                            <input type="text" name="descripcion" id="descripcion"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                value="{{ $producto->descripcion ?? '' }}">
                            <x-input-error :messages="$errors->get('descripcion')" class="mt-2" />

                        </div>
                        <div>

                            <label for="stock"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Stock</label>
                            <input type="number" name="stock" id="stock"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                value="{{ $producto->stock ?? '' }}">
                            <x-input-error :messages="$errors->get('stock')" class="mt-2" />

                        </div>
                        <div>
                            <label for="precio"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Precio</label>
                            <input type="number" name="precio" id="precio"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                value="{{ $producto->precio ?? '' }}">
                            <x-input-error :messages="$errors->get('precio')" class="mt-2" />

                        </div>
                        <div class="mt-6">
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-600 active:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 dark:bg-gray-600 dark:border-gray-600 dark:text-white dark:hover:bg-gray-700 dark:focus:ring-gray-700">
                                Guardar producto
                            </button>

                            <a href="{{ route('producto') }}" type="button"
                                class="inline-flex items-center px-4 py-2 bg-red-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-600 active:bg-red-700 focus:outline-none focus:border-red-700 focus:ring focus:ring-red-200 dark:bg-gray-600 dark:border-gray-600 dark:text-white dark:hover:bg-gray-700 dark:focus:ring-gray-700">
                                Cancelar
                            </a>
                        </div>
                    </form>
                </div>

            </div>
        </div>
</x-app-layout>
