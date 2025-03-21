@extends('adminlte::page')

@section('title', 'DeveloTech')
@section('css')
@stop
@section('content_header')
    <h1>Lista de Vehículos</h1>
@stop

@section('content')
    <!-- Mostrar errores si existen -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li><strong>{{ $error }}</strong></li>
                    <!-- Cambié el <strong> a <li> para una mejor estructura -->
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Vehículos registrados</h3>
                    <div class="card-tools">
                        <a class="btn btn-secondary" data-toggle="modal" data-target="#createVehiculoModal">
                            <i class="bi bi-plus-circle-fill"></i>
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    @if ($info = Session::get('info'))
                        <div class="alert alert-success"><strong>{{ $info }}</strong></div>
                    @endif

                    <table id="vehiculos" class="table table-striped table-bordered table-hover table-sm">
                        <thead>
                            <tr>
                                <th>Placa</th>
                                <th>Modelo</th>
                                <th>Disponible</th>
                                <th>Tipo</th>
                                <th>Profesor</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($vehiculos as $vehiculo)
                                <tr>
                                    <td>{{ $vehiculo->placa }}</td>
                                    <td>{{ $vehiculo->modelo }}</td>
                                    <td>{{ $vehiculo->disponible ? 'Sí' : 'No' }}</td>
                                    <td>{{ $vehiculo->tipo }}</td>
                                    <td>{{ $vehiculo->nombres . ' ' . $vehiculo->apellidos }}</td>
                                    <td>
                                        <a href="#" class="btn btn-primary" data-id="{{ $vehiculo->id }}"
                                            data-toggle="modal" data-target="#showVehiculoModal">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="#" class="btn btn-warning" data-id="{{ $vehiculo->id }}"
                                            data-toggle="modal" data-target="#editVehiculoModal">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.vehiculos.destroy', $vehiculo->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"><i
                                                    class="fas fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                     @include('admin.vehiculos.create')
                    @include('admin.vehiculos.edit')
                    @include('admin.vehiculos.show')
                </div> <!-- Modales para crear y editar vehículos -->

            </div>
        </div>
    </div>



@endsection

@section('js')
    
    
    

    <!-- Buttons JS -->
    
    
    
    
    
    
    <script>
        new DataTable('#vehiculos', {
            responsive: true,
            autoWidth: false, //no le vi la funcionalidad
            dom: 'Bfrtip', // Añade el contenedor de botones
            buttons: [{
                extend: 'collection',
                text: 'Reportes',
                orientation: 'landscape',
                buttons: ['copy', 'csv', 'excel', 'pdf', 'print',
                'colvis'], // Botones que aparecen en la imagen
            }, ],
            "language": {
                "decimal": "",
                "emptyTable": "No hay datos disponibles en la tabla",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ vehiculos",
                "infoEmpty": "Mostrando 0 a 0 de 0 vehiculos",
                "infoFiltered": "(filtrado de _MAX_ vehiculos totales)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ vehiculos",
                "loadingRecords": "Cargando...",
                "processing": "",
                "search": "Buscar:",
                "zeroRecords": "No se encontraron registros coincidentes",
                "paginate": {
                    "first": "Primero",
                    "last": "Último",
                    "next": "Siguiente",
                    "previous": "Anterior"
                },
                "aria": {
                    "orderable": "Ordenar por esta columna",
                    "orderableReverse": "Invertir el orden de esta columna"
                }
            },
            initComplete: function() {
                // Apply custom styles after initialization
                $('.dt-button').css({
                    'background-color': '#4a4a4a',
                    'color': 'white',
                    'border': 'none',
                    'border-radius': '4px',
                    'padding': '8px 12px',
                    'margin': '0 5px',
                    'font-size': '14px'
                });
            },
        });
    </script>

    <script>
        $('#editVehiculoModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var modal = $(this);
            var url = "{{ route('admin.vehiculos.edit', ':id') }}".replace(':id', button.data('id'));

            $.ajax({
                url: url,
                method: 'GET',
                success: function(data) {
                    modal.find('#edit_vehiculo_id').val(data.vehiculo.id);
                    modal.find('#placa').val(data.vehiculo.placa);
                    modal.find('#modelo').val(data.vehiculo.modelo);
                    modal.find('#disponible').val(data.vehiculo.disponible ? '1' : '0');
                    modal.find('#tipo').val(data.vehiculo.tipo);
                    modal.find('#picoyplaca_id').val(data.vehiculo.picoyplaca_id);
                    modal.find('#profesor_nombres').val(data.vehiculo.profesor.nombres + ' ' + data
                        .vehiculo.profesor.apellidos);

                    // Limpiar y agregar opciones al select de tipo
                    var tipoSelect = modal.find('#tipo_select');
                    tipoSelect.empty();
                    ['Sedan', 'SUV', 'Pickup', 'Hatchback'].forEach(function(tipo) {
                        tipoSelect.append(new Option(tipo, tipo.toLowerCase()));
                    });
                    tipoSelect.val(data.vehiculo.tipo); // Establecer el valor seleccionado

                    // Limpiar y agregar opciones al select de profesores
                    var profesorSelect = modal.find('#profesor_select');
                    profesorSelect.empty();
                    $.each(data.profesores, function(index, profesor) {
                        profesorSelect.append(new Option(profesor.nombres + ' ' + profesor
                            .apellidos, profesor.id));
                    });
                    profesorSelect.val(data.vehiculo.profesor_id); // Establecer el valor seleccionado
                },
                error: function(xhr) {
                    console.error('Error al cargar los datos del vehículo:', xhr);
                }
            });
        });
    </script>

    <script>
        function formatearPlaca(input) {
            let valor = input.value.replace(/-/g, ''); // Eliminar guiones existentes
            if (valor.length >= 3) {
                valor = valor.slice(0, 3) + '-' + valor.slice(3); // Agregar guion después de 3 caracteres
            }
            if (valor.length > 7) {
                valor = valor.slice(0, 7); // Limitar a 7 caracteres
            }
            input.value = valor.toUpperCase(); // Convertir a mayúsculas
        }
    </script>
<script>
    $('#createVehiculoModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); // Botón que activó el modal
        var modal = $(this); // Define modal como el modal actual
        var url = "{{ route('admin.vehiculos.create', ':id') }}"; // Corrige la ruta aquí
        url = url.replace(':id', button.data('id')); // Reemplaza ':id' con el ID del vehículo

        // Hacer una solicitud AJAX para obtener los datos del vehículo
        $.ajax({
            url: url, // URL de la API o endpoint
            method: 'GET',
            success: function(data) {
                // var select1 = modal.find('#tipo_select'); // Asegúrate de que este es el ID de tu select
                // select1.empty(); // Limpiar las opciones existentes

                // Opciones de tipo
                // select1.append(new Option('Sedan', 'sedan'));
                // select1.append(new Option('SUV', 'suv'));
                // select1.append(new Option('Pickup', 'pickup'));
                // select1.append(new Option('Hatchback', 'hatchback'));

                // Obtener y limpiar el select de profesor
                var select = modal.find('#profesor_select'); // Asegúrate de que este es el ID de tu select
                select.empty(); // Limpiar las opciones existentes
                $.each(data.profesores, function(index, profesor) {
                    select.append(new Option(profesor.nombres + ' ' + profesor.apellidos, profesor.id));
                });
                
                // Establecer el valor seleccionado del profesor, si existe
                if (data.vehiculo) {
                    select.val(data.vehiculo.profesor_id); // Establecer el valor seleccionado
                }
            },
            error: function(xhr) {
                console.error('Error al cargar los datos del vehículo:', xhr);
            }
        });
    });
    
</script>
@endsection
