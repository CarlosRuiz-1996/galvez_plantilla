<x-app-layout>
   <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script> -->
   <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

   <link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="http://www.datatables.net/rss.xml">
   <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
   <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css">
    <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
   <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
   <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
   <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script><!-- excel -->
   <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
   <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
   <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>    
  

   <style>
    .table-container {
    max-height: 300px; /* Ajusta la altura máxima según sea necesario */
    overflow-y: auto; /* Agrega una barra de desplazamiento vertical si es necesario */
}
   
/* Agrega reglas de estilo según sea necesario */
#miTabla {
    max-height: 400px; /* Ajusta la altura máxima según sea necesario */
    overflow-y: auto; /* Agrega una barra de desplazamiento vertical si es necesario */
}
.dataTables_wrapper .dt-buttons .dt-button {
    padding: 5px 10px; /* Ajusta el padding según sea necesario para el tamaño deseado */
    font-size: 10px; /* Ajusta el tamaño de fuente según sea necesario */
}
.dataTables_wrapper .dataTables_paginate .paginate_button {
    padding: 5px 10px; /* Ajusta el padding según sea necesario para el tamaño deseado */
    font-size: 12px; /* Ajusta el tamaño de fuente según sea necesario */
}

/* Reducir el tamaño del botón de "Mostrar Número de Registros" */
.dataTables_length select {
    padding: 2px; /* Ajusta el padding según sea necesario para el tamaño deseado */
    font-size: 12px; /* Ajusta el tamaño de fuente según sea necesario */
}
</style>
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
                            @foreach ($hospitals as $hospital)
                                <option value="{{ $hospital->id }}"
                                    {{ request('hospital_id') == $hospital->id ? 'selected' : '' }}>
                                    {{ $hospital->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="filter_date" class="font-medium">Filtrar por Fecha:</label>
                        <input type="date" name="filter_date" id="filter_date" value="{{ request('filter_date') }}"
                            class="border rounded-md px-2 py-1">
                    </div>
                    <div>
                        <button type="submit" class="bg-blue-500 text-white px-1 py-2 rounded-md">
                            Aplicar Filtros
                        </button>
                        <button type="button" class="bg-green-700 text-white px-1 py-2 rounded-md">
                            EXCEL
                        </button>
                        <button type="button" class="bg-red-500 text-white px-1 py-2 rounded-md">
                            PDF
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
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Total de pedidos 
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
        <div class="modal-content bg-white rounded-lg h-[80vh] w-[80vw]">
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
        $(document).ready(function() {
    const detallesButtons = document.querySelectorAll('.detalles-btn');
    const modal = document.getElementById('detalleModal');
    const modalContent = modal.querySelector('.modal-body');
    
    detallesButtons.forEach(button => {
        button.addEventListener('click', function (event) {
            event.preventDefault();
            event.stopPropagation();
    
            const pedidoId = button.getAttribute('data-id');
    
            modalContent.innerHTML = '<p>Cargando detalles...</p>';
    
            $.ajax({
                url: '/admin/orders/' + pedidoId + '/detalleadmin',
                method: 'GET',
                success: function(response) {
                    modalContent.innerHTML = response;
                    
                    // Inicializa DataTables después de cargar el contenido
                    $('#miTabla').DataTable({
    dom: 'Brtip',
    ordering: false,
    autoWidth: true, // Habilita los botones de exportación
    buttons: [
        'excel', // Botón de Excel
        'pdf' // Botón de PDF
    ],
    order: [],
    "language": {
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros por página",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningún dato disponible en esta tabla",
            "sInfo": "Mostrando datos del _START_ al _END_ de un total de _TOTAL_ datos",
            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix": "",
            "sSearch": "Buscar:",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        }
});
                },
                error: function() {
                    modalContent.innerHTML = '<p>Error al cargar los detalles.</p>';
                }
            });
    
            modal.classList.remove('hidden');
        });
    });
    
    modal.addEventListener('click', function (event) {
        if (event.target === modal) {
            modal.classList.add('hidden');
        }
    });
});

    </script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
      <script src="assets/js/scripts.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
      <!-- <script src="assets/demo/chart-area-demo.js"></script>
      <script src="assets/demo/chart-bar-demo.js"></script> -->
      <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
      <script src="assets/js/datatables-simple-demo.js"></script>
</x-app-layout>
