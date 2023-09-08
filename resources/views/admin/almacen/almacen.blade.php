<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-purple-800 dark:text-gray-200 leading-tight">
            {{ __('Productos') }}
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
                                placeholder="Busca un producto">
                        </div>
                    </div>
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">NOMBRE</th>
                                <th scope="col" class="px-6 py-3">GRAMAJE</th>
                                <th scope="col" class="px-6 py-3">PRESENTACIÓN</th>
                                <th scope="col" class="px-6 py-3 ">STOCK</th>
                                <th scope="col" class="px-6 py-3">ACCIONES</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($productos as $producto)
                                <tr
                                    class="table-row bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td class="px-6 py-4" data-amount="{{ $producto->descripcion }}">
                                        {{ $producto->descripcion }}</td>
                                    <td class="px-6 py-4">{{ $producto->grammage->name }}
                                    </td>
                                    <td class="px-6 py-4">{{ $producto->presentation->name }}
                                    </td>
                                    <td class="px-6 py-4 {{ $producto->stock < 10 ? 'bg-orange-300' : 'bg-orange-200' }}">
                                        {{ $producto->stock }}
                                    </td>                                    
                                    </td>
                                    <td class="px-6 py-4" data-status="{{ $producto->estatus }}">
                                        <a href="{{ route('admin.almacen.editStock', $producto->id) }}">Editar Stock</a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>

            </div>
            {{-- paginacion --}}

            <div class="clearfix"></div>
            <div class="pb-12">
                {{ $productos->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
