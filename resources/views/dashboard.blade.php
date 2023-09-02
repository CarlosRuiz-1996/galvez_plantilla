<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-purple-800 dark:text-gray-200 leading-tight">
            {{ __('Inicio') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-alert />


            @if (Auth::check() && Auth::user()->hasRole('Admin'))
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <!-- Llamar al componente de gráfica aquí -->

                    <div class="flex">

                        <div class="w-1/2 p-2">


                            <h1>Ingresos</h1>

                            <x-nav-tab-ingreso />
                        </div>

                        <div class="w-1/2 p-2">
                            <h1>Estadistica mensuales</h1>
                            <x-line-chart :data="[
                                'labels' => ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio'],
                                'values' => [50, 20, 30, 5, 80, 60],
                            ]" />
                        </div>

                    </div>
                    <br>
                    <br>
                    <hr>
                    <br>
                    <br>
                    <div class="p-4">
                        <h1 class="text-center"> <b>Productos con poco stock</b></h1>
                        <x-poco-stock :data="[
                            [
                                'nombre' => 'Producto 1',
                                'descripcion' => 'Descripción del producto 1',
                                'stock' => 10,
                                'ultima_surtida' => '2023-08-15',
                            ],
                            [
                                'nombre' => 'Producto 2',
                                'descripcion' => 'Descripción del producto 2',
                                'stock' => 25,
                                'ultima_surtida' => '2023-08-20',
                            ],
                            // ... Agrega más filas de datos aquí ...
                        ]" />
                    </div>
                </div>
            @elseif (Auth::check() && Auth::user()->hasRole('Hospital'))
                {{-- {{var_dump(auth()->user()->hospitals)}} --}}

                @if (!auth()->user()->hospitals->isEmpty())
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

                    <div class="flex">

                        <div class="w-1/2 p-2">


                            <h1>Consumos</h1>

                            <x-nav-tab-ingreso />
                        </div>

                        <div class="w-1/2 p-2">
                            <h1>Estadistica mensuales</h1>
                            <x-line-chart :data="[
                                'labels' => ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio'],
                                'values' => [50, 20, 30, 5, 80, 60],
                            ]" />
                        </div>

                    </div>
                </div>
                @else
                    <div
                        class="text-center max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                        <a href="#">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                Indica cual es tu hospital
                            </h5>
                        </a>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                            Para poder vizualizar acciones de administrador y gestionar tu hospital indica cual es.</p>
                        <a href="{{ route('hospitals.asignar') }}"
                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Ir
                            <svg class="w-3.5 h-3.5 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                            </svg>
                        </a>
                    </div>
                @endif
            @endif
        </div>
    </div>
</x-app-layout>
