<!-- resources/views/components/datatable-table.blade.php -->
{{-- @push('styles') --}}
    <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
{{-- @endpush --}}

<table id="dataTable" class="stripe hover" style="width:100%">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Stock</th>
            <th>Última Surtida</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $item)
            <tr>
                <td>{{ $item['nombre'] }}</td>
                <td>{{ $item['descripcion'] }}</td>
                <td>{{ $item['stock'] }}</td>
                <td>{{ $item['ultima_surtida'] }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

{{-- @push('scripts') --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
    </script>
{{-- @endpush --}}
