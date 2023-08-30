<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-purple-800 dark:text-gray-200 leading-tight">
            {{ __('Pedidos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-alert />

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                {{-- {{var_dump($pedidos->hospitales)}} --}}
                @foreach ($pedidos as $pedido)
                    <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                        <a href="#">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Noteworthy
                                {{ $pedido->hospital->nombre }}
                            </h5>
                        </a>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                           Fecha de entrega: {{ $pedido->fecha_pedido }}
                        </p>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                             
                            @if ( $pedido->estatus == 1)
                            <span class="bg-blue-100 text-orange-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-orange-700 dark:text-orange-300">
                                Pendiente
                            </span>
                            @else 
                            <span class="bg-blue-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">
                                Entregado
                            </span>   
                            @endif
                           

                         </p>
                        <a href="{{route('pedido.detalle',['id' => $pedido->id])}}"
                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-orange-700 rounded-lg hover:bg-orange-800 focus:ring-4 focus:outline-none focus:ring-orange-300 dark:bg-orange-600 dark:hover:bg-orange-700 dark:focus:ring-orange-800">
                            Detalles
                            <svg class="w-3.5 h-3.5 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                            </svg>
                        </a>
                    </div>
                @endforeach

                 {{-- paginacion --}}

            <div class="clearfix"></div>
            {{-- {{ $pedidos->links() }} --}}
            </div>
        </div>
    </div>
</x-app-layout>
