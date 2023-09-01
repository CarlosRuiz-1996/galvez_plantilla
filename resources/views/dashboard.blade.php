<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-purple-800 dark:text-gray-200 leading-tight">
            {{ __('Inicio') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-alert />

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
        </div>
    </div>
</x-app-layout>
