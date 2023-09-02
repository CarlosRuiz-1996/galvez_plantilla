<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-purple-800 dark:text-gray-200 leading-tight">
            @if (isset($listado) && is_object($listado))
                {{ __('Editar '.$catalogo) }}
            @else
                {{ __('Agregar al catalogo '.$catalogo) }}
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
                        action="{{ isset($listado) ? route('admin.catalogs.update',$catalogo) : route('admin.catalogs.guardar', $catalogo) }}"
                        method="post">
                        @csrf
                        @if (isset($listado) && is_object($listado))
                            <input type="text" hidden name="id" value="{{ $listado->id ?? '' }}" />
                        @endif

                        <div>
                            <label for="name"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nombre</label>
                            <input type="text" name="name" id="name"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                value="{{ $listado->name ?? '' }}">
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                        @if ($catalogo == 'Categoria')
                            <!-- Campo adicional para categorías -->
                            <div class="mt-6">
                                <label for="palabra_clave" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Palabras clave</label>
                                <input type="text" name="palabra_clave" id="palabra_clave"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                    value="{{ $listado->palabra_clave ?? '' }}" placeholder="palabras separadas por ',' Ejemplo:manzana,sandia,cirule">
                                <!-- Puedes ajustar el nombre del campo y su identificador según tus necesidades -->
                            </div>
                        @endif

                       

                        <div class="mt-6">
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-600 active:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 dark:bg-gray-600 dark:border-gray-600 dark:text-white dark:hover:bg-gray-700 dark:focus:ring-gray-700">
                                Guardar producto
                            </button>

                            <a href="{{ route('admin.catalogs') }}" type="button"
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
