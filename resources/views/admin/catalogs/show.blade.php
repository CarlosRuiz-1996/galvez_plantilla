<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-purple-800 dark:text-gray-200 leading-tight inline-flex items-center">
            <a href="{{ route('admin.catalogs') }}" title="ATRAS">
                <svg class="w-5 h-5 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="4"
                        d="M13 5H3M8 1L3 5l5 4" />
                </svg>
            </a>
            &nbsp;
            {{ __('Catalogo de ' . $catalogo) }}
        </h2>



    </x-slot>


    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="">
            <div class="mt-4 p-5">
                <x-alert />


                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <div class="flex items-center justify-between pb-4">
                        <div>
                            {{-- espacio para el buscador --}}
                            <a href="{{ route('admin.catalogs.crear', $catalogo) }}" type="button"
                                class="focus:outline-none text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">
                                Nuevo +
                            </a>

                        </div>
                        <label for="table-search" class="sr-only">Buscar</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <input type="text" id="table-search"
                                class="block p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Buscar">
                        </div>
                    </div>
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">Nombre</th>
                                @if ($catalogo == 'Categoria')
                                    <th scope="col" class="px-6 py-3">Palabras clave</th>
                                @endif
                                <th scope="col" class="px-6 py-3">Estatus</th>
                                <th scope="col" class="px-6 py-3">Fecha de alta</th>
                                <th scope="col" class="px-6 py-3">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($listado as $list)
                                <tr
                                    class="table-row bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td class="px-6 py-4" data-name="{{ $list->name }}">{{ $list->name }}
                                    </td>
                                    @if ($catalogo == 'Categoria')
                                        <td class="px-6 py-4" data-name="{{ $list->palabra_clave }}">
                                            {{ $list->palabra_clave }}
                                        </td>
                                    @endif
                                    <td class="px-6 py-4" data-status="{{ $list->status }}">
                                        @if ($list->status == 1)
                                            <div class="p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-100 dark:bg-gray-800 dark:text-blue-400"
                                                role="alert">
                                                <span class="font-medium">ACTIVO</span>
                                            </div>
                                        @else
                                            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-100 dark:bg-gray-800 dark:text-red-600"
                                                role="alert">
                                                <span class="font-medium">BAJA</span>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4" data-created_at="{{ $list->created_at }}">
                                        {{ $list->created_at }}
                                    </td>
                                    <td class="px-6 py-4">
                                        @if ($list->status != 0)
                                            <a href="{{ route('admin.catalogs.edit', ['ctg' => $catalogo, 'id' => $list->id]) }}"
                                                class="text-blue-600 hover:underline">Editar</a>
                                            <form
                                                action="{{ route('admin.catalogs.destroy', ['ctg' => $catalogo, 'id' => $list->id]) }}"
                                                method="get">
                                                @csrf

                                                <button type="submit"
                                                    class="text-red-600 hover:underline">Eliminar</button>
                                            </form>
                                        @else
                                            <form
                                                action="{{ route('admin.catalogs.reactivar', ['ctg' => $catalogo, 'id' => $list->id]) }}"
                                                method="get">
                                                @csrf

                                                <button type="submit"
                                                    class="text-green-600 hover:underline">Reactivar</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>


                </div>
                {{-- paginacion --}}

                <div class="clearfix"></div>
                <div class="pb-12">
                    {{ $listado->links() }}
                </div>
            </div>


        </div>
    </div>
</x-app-layout>
