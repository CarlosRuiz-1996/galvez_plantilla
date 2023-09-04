<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-purple-800 dark:text-gray-200 leading-tight">
            {{ __('Pedidos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-alert />

            <div class="mb-4 flex justify-between items-center">
                <form class="flex space-x-4" action="{{ route('admin.orders') }}" method="GET">
                    <div>
                        <label for="hospital_id" class="font-medium">Filtrar por Hospital:</label>
                        <select name="hospital_id" id="hospital_id" class="border rounded-md px-2 py-1">
                            <option value="">Todos los hospitales</option>
                            @foreach($hospitals as $hospital)
                                <option value="{{ $hospital->id }}"
                                    {{ request('hospital_id') == $hospital->id ? 'selected' : '' }}>
                                    {{ $hospital->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="filter_date" class="font-medium">Filtrar por Fecha:</label>
                        <input type="date" name="filter_date" id="filter_date"
                            value="{{ request('filter_date') }}" class="border rounded-md px-2 py-1">
                    </div>
                    <div>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">
                            Aplicar Filtros
                        </button>
                    </div>
                </form>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Hospital
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Total
                            </th>
                            <th scope="col" class="px-6 py-3">
                                <span class="sr-only">Detalles</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($pedidos as $pedido)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $hospitals->where('id', $pedido->hospital_id)->first()->name ?? 'N/A' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $pedido->orders_count }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a type="button" class="text-orange-700 detalles-btn" data-id="{{ $pedido->hospital_id }}">
                                    Detalles
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $pedidos->appends(request()->except('page'))->links() }}
            </div>
        </div>
    </div>
    <div id="detalleModal" class="modal hidden fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
        <div class="modal-content bg-white rounded-lg">
            <!-- Encabezado del modal -->
            <div class="modal-header bg-gray-200 px-4 py-2 rounded-t-lg flex justify-between items-center">
                <h3 class="text-lg font-semibold text-gray-800">Detalles del Pedido</h3>
                <!-- Botón de cerrar -->
                <button class="text-gray-600 hover:text-gray-800" onclick="cerrarModal(event)">
                    X
                </button>
            </div>
            <!-- Cuerpo del modal -->
            <div class="modal-body p-6">
                <!-- Aquí se cargarán los detalles del pedido mediante AJAX -->
                <p>Cargando detalles...</p>
            </div>
            <!-- Pie de página (footer) del modal -->
            <div class="modal-footer bg-gray-200 px-4 py-2 rounded-b-lg">
                <button class="" onclick="cerrarModal(event)">Cerrar</button>
            </div>
            <!-- Agregar un botón de cerrar -->
            
        </div>
    </div>
    
    <script>
        function cerrarModal(event) {
            event.stopPropagation(); // Detiene la propagación del evento
            const modal = document.getElementById('detalleModal');
            modal.classList.add('hidden');
        }
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const detallesButtons = document.querySelectorAll('.detalles-btn');
            const modal = document.getElementById('detalleModal');
            const modalContent = modal.querySelector('.modal-body');
        
            detallesButtons.forEach(button => {
                button.addEventListener('click', function (event) {
                    event.preventDefault(); // Evita el comportamiento predeterminado del enlace/button
                    event.stopPropagation(); // Detiene la propagación del evento
        
                    const pedidoId = button.getAttribute('data-id');
        
                    // Lógica para cargar los detalles del pedido en el modal (puedes usar AJAX)
                    cargarDetallesPedido(pedidoId);
        
                    // Muestra el modal
                    modal.classList.remove('hidden');
                });
            });
        
            // Cierra el modal al hacer clic fuera de él
            modal.addEventListener('click', function (event) {
                if (event.target === modal) {
                    modal.classList.add('hidden');
                }
            });
        
            function cargarDetallesPedido(pedidoId) {
                // Utiliza AJAX para cargar los detalles del pedido en el modalContent
                // Por ejemplo:
                modalContent.innerHTML = '<p>Cargando detalles...</p>';
                // Realiza la solicitud AJAX para cargar los detalles del pedido
                $.ajax({
                    url: '/admin/orders/' + pedidoId + '/detalleadmin',
                    method: 'GET',
                    success: function(response) {
                        modalContent.innerHTML = response;
                    },
                    error: function() {
                        modalContent.innerHTML = '<p>Error al cargar los detalles.</p>';
                    }
                });
            }
        });
    </script>
    <script>
        $(document).ready(function () {
            $('#exportExcel').click(function () {
                alert("clic");
                $.ajax({
                    url: '{{ route('export.excel') }}', // Reemplaza 'export.excel' con la ruta adecuada a tu controlador
                    method: 'GET',
                    success: function (response) {
                        // Crea un enlace temporal y haz clic en él para iniciar la descarga
                        var a = document.createElement('a');
                        a.href = response.file_path; // La respuesta del controlador debe incluir la ruta del archivo Excel
                        a.download = 'tabla_pedidos.xlsx'; // Nombre del archivo
                        a.style.display = 'none';
                        document.body.appendChild(a);
                        a.click();
                        document.body.removeChild(a);
                    },
                    error: function () {
                        alert('Error al exportar a Excel');
                    }
                });
            });
        });
    </script>
</x-app-layout>
