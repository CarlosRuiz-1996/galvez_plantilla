<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detalle de hospital') }}
        </h2>
    </x-slot>

    <div class="">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <x-alert />
            <br>
            <div class=" bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div
                    class=" block rounded-lg bg-white shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-neutral-700">

                    <?php //var_dump($hospital->pedidos)
                    ?>
                    <div class="flex">

                        <div class="w-1/2 p-2 text-center">
                            @if ($hospital->image_path)
                                <img src="{{ asset('img/vacio.jpg') }}" class="w-100" alt="">
                            @else
                                <img src="{{ asset('img/vacia.png') }}" class="w-100" alt="">
                            @endif


                        </div>

                        <div class="w-1/2 p-2">
                            {{-- <h1>Estadistica mensuales</h1>
                            <x-line-chart :data="[
                                'labels' => ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio'],
                                'values' => [50, 20, 30, 5, 80, 60],
                            ]" /> --}}
                            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                                {{-- <p class="text-2xl font-semibold text-gray-800 dark:text-white">Detalles del Hospital
                                </p> --}}
                                <div class="mt-4 space-y-3">
                                    <p class="text-lg text-gray-600 dark:text-gray-400">Nombre: <span
                                            class="font-semibold">{{ $hospital->name }}</span></p>
                                    <p class="text-lg text-gray-600 dark:text-gray-400">Dirección: <span
                                            class="font-semibold">{{ $hospital->address }}</span></p>
                                    <p class="text-lg text-gray-600 dark:text-gray-400">Teléfono: <span
                                            class="font-semibold">{{ $hospital->phone }}</span></p>
                                    <p class="text-lg text-gray-600 dark:text-gray-400">Correo: <span
                                            class="font-semibold">{{ $hospital->email }}</span></p>
                                    <p class="text-lg text-gray-600 dark:text-gray-400">Nombre de contacto: <span
                                            class="font-semibold">{{ $hospital->contact_name }}</span></p>
                                    <p class="text-lg text-gray-600 dark:text-gray-400">Telefono de contacto: <span
                                            class="font-semibold">{{ $hospital->contact_phone }}</span></p>
                                    <p class="text-lg text-gray-600 dark:text-gray-400">Correo de contacto: <span
                                            class="font-semibold">{{ $hospital->contact_email}}</span></p>
                                </div>
                                <div class="mt-6 flex justify-end space-x-4">
                                    <a href="{{ route('admin.hospitals.editar', $hospital->id) }}"
                                        class="text-blue-600 hover:underline">Editar</a>
                                    <form action="{{ route('admin.hospitals.eliminar', $hospital->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline">Eliminar</button>
                                    </form>
                                </div>
                                <hr>
                                <h1 class="mt-3">Compras mensuales</h1>
                                <x-line-chart :data="[
                                    'labels' => ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio'],
                                    'values' => [50, 20, 30, 5, 80, 60],
                                ]" />
                            </div>



                        </div>

                    </div>
                    <div class="mt-4  p-5">

                        @if (count($hospital->pedidos) > 0)
                            <hr>
                            <p class="mt-2 text-lg text-gray-600 dark:text-gray-400 text-center"> <span
                                    class="font-semibold">PEDIDOS</span></p>
                            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                                <div class="flex items-center justify-between pb-4">
                                    <div>
                                        {{-- espacio para el buscador --}}
                                    </div>
                                    <label for="table-search" class="sr-only">Buscar</label>
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                            <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                                fill="currentColor" viewBox="0 0 20 20"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                        <input type="text" id="table-search"
                                            class="block p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="Busca un pedido">
                                    </div>
                                </div>
                                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                    <thead
                                        class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                        <tr>
                                            <th scope="col" class="px-6 py-3">FECHA SOLICITADA</th>
                                            <th scope="col" class="px-6 py-3">MONTO</th>
                                            <th scope="col" class="px-6 py-3">OBSERVACIONES</th>

                                            <th scope="col" class="px-6 py-3">ENTREGA</th>
                                            <th scope="col" class="px-6 py-3">ESTATUS</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($hospital->pedidos as $pedido)
                                            <tr
                                                class="table-row bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                                <td class="px-6 py-4" data-date="{{ $pedido->updated_at }}">
                                                    {{ $pedido->updated_at }}</td>
                                                <td class="px-6 py-4" data-amount="{{ $pedido->total }}">
                                                    ${{ $pedido->total }}</td>
                                                <td class="px-6 py-4" data-date="{{ $pedido->observations }}">
                                                    {{ $pedido->observations }}</td>

                                                <td class="px-6 py-4" data-delivery="{{ $pedido->deadline }}">
                                                    {{ $pedido->deadline }}</td>
                                                <td class="px-6 py-4" data-status="{{ $pedido->status }}">
                                                    {{ $pedido->status == 1 ? 'PENDIENTE' : 'ENTREGADO' }}</td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>

                        @endif
                    </div>
                </div>



            </div>

        </div>

</x-app-layout>
