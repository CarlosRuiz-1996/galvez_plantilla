<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-purple-800 dark:text-gray-200 leading-tight">
                {{ __('Editar stock') }}
        </h2>
    </x-slot>

    <div class="">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <x-alert />
            <br>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                    <form method="POST" action="{{ route('admin.almacen.actualizar-stock', $producto->id) }}">
                        @csrf
                        @method('PUT')            
                        <div>
                            <label for="stockhay"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Cantidad de productos actual</label>
                            <input type="number" name="stockhay" id="stockhay"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                value="{{ $producto->stock ?? '' }}" step="10" disabled>
                            <x-input-error :messages="$errors->get('stock')" class="mt-2" />
                        </div>

                        <div>
                            <label for="stock"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Cantidad a ingresar</label>
                            <input type="text" name="stock" id="stock"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                value="0">
                            <x-input-error :messages="$errors->get('stock')" class="mt-2" />
                        </div>


                        <div class="mt-6">
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-600 active:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 dark:bg-gray-600 dark:border-gray-600 dark:text-white dark:hover:bg-gray-700 dark:focus:ring-gray-700">
                                Guardar cantidad
                            </button>

                            <a href="{{ route('admin.almacen') }}" type="button"
                                class="inline-flex items-center px-4 py-2 bg-red-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-600 active:bg-red-700 focus:outline-none focus:border-red-700 focus:ring focus:ring-red-200 dark:bg-gray-600 dark:border-gray-600 dark:text-white dark:hover:bg-gray-700 dark:focus:ring-gray-700">
                                Cancelar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

