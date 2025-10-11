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
                                    <td>{{ $vehiculo->tipo->tipo }}</td>
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
{{-- DATA TABLE --}}
    <script>
        new DataTable('#vehiculos', {
            responsive: true,scrollX: true,
            autoWidth: false, 
            dom: 'Bfrtip', 
            buttons: [{
                extend: 'collection',
                text: 'Reportes',
                orientation: 'landscape',
                buttons: [{extend: 'copyHtml5',text: '<i class="bi bi-clipboard-check"></i> Copiar'}, // Added btn-sm for better consistency
                          {extend: 'csvHtml5',text: '<i class="bi bi-filetype-csv"></i> CSV'},
                          {extend: 'excelHtml5',text: '<i class="bi bi-file-earmark-excel"></i> Excel'},
                          {extend: 'pdfHtml5',text: '<i class="bi bi-filetype-pdf"></i> PDF'},
                          {extend: 'print',text: '<i class="bi bi-printer"></i> Imprimir' },
                          {extend: 'colvis'}],
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
                "paginate": {"first": "Primero","last": "Último","next": "Siguiente","previous": "Anterior"},
                "aria": {"orderable": "Ordenar por esta columna","orderableReverse": "Invertir el orden de esta columna"}
            },
            initComplete: function() {
                // Apply custom styles after initialization
                $('.dt-button').css({'background-color': '#4a4a4a', 
                                     'color': 'white','border': 'none',
                                     'border-radius': '4px','padding': '8px 12px',
                                     'margin': '0 5px','font-size': '14px'});
            },
        });
    </script>
    <script src="{{ asset('js/helpers.js') }}"></script>

{{-- SHOW MODAL --}}
    <script>
        $('#showVehiculoModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var modal = $(this);

            var url = "{{ route('admin.vehiculos.show', ':id') }}".replace(':id', id);

            $.ajax({
                url: url,
                method: 'GET',
                success: function(data) {
                    // Llenar los campos de solo lectura
                    modal.find('#show-placa').text(data.vehiculo.placa);
                    modal.find('#show-modelo').text(data.vehiculo.modelo);
                    modal.find('#show-disponible').text(data.vehiculo.disponible ? 'Sí' : 'No');
                    modal.find('#show-tipo').text(data.vehiculo.tipo ? data.vehiculo.tipo.tipo :
                        'No definido');
                    modal.find('#show-profesor').text(data.vehiculo.profesor ? data.vehiculo.profesor
                        .nombres + ' ' + data.vehiculo.profesor.apellidos : 'No asignado');
                },
                error: function(xhr) {
                    console.error('Error al cargar los datos del vehículo:', xhr);
                }
            });
        });
    </script>
{{-- EDIT MODAL --}}
    <script>
        $('#editVehiculoModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var modal = $(this);
            var url = "{{ route('admin.vehiculos.edit', ':id') }}".replace(':id', button.data('id'));

            $.ajax({
                url: url,
                method: 'GET',
                success: function(data) {
                    // modal.find('#edit_vehiculo_id').val(data.vehiculo.id);
                    modal.find('#placa').val(data.vehiculo.placa);
                    modal.find('#modelo').val(data.vehiculo.modelo);
                    modal.find('#disponible').val(data.vehiculo.disponible ? '1' : '0');

                    // --- TIPOS ---Limpiar y agregar opciones al select de tipos
                    var tipoSelect = modal.find('#tipo_selected');
                    tipoSelect.empty(); 
                    $.each(data.tipos, function(index, tipo) {
                        tipoSelect.append(new Option(tipo.tipo, tipo.id)); // uso tipo.id
                    });
                    // forzar string por si acaso
                    tipoSelect.val(data.vehiculo.tipo_id ? String(data.vehiculo.tipo_id) : '').trigger('change');

                    // --- PROFESORES ---
                    var profesorSelect = modal.find('#profesor_select_edit');
                    profesorSelect.empty(); // Mostrar nombres + apellidos cuando existan, si no usar name (fallback) 
                    $.each(data.profesores, function(index, profesor) {
                        var texto = (profesor.nombres && profesor.apellidos) ? profesor.nombres + ' ' + profesor.apellidos :
                            (profesor.name || 'Profesor');
                        profesorSelect.append(new Option(texto, profesor.id)); 
                    });
                    var profId = data.vehiculo.profesor_id;
                    profesorSelect.val(profId ? String(profId) : '').trigger('change');

                    // fallback: si por alguna razón no se seleccionó (plugin o mismatch), forzar .prop('selected')
                    if (profId && profesorSelect.val() !== String(profId)) {
                        profesorSelect.find('option').each(function() {
                            if ($(this).val() == profId) $(this).prop('selected', true);
                        });
                    }

                    // CRUCIAL: Set the form's action URL dynamically
                    var formAction = "{{ route('admin.vehiculos.update', ':id') }}".replace(':id', data
                        .vehiculo.id);
                    modal.find('#editForm').attr('action', formAction);
                },
                error: function(xhr) {
                    console.error('Error al cargar los datos del vehículo:', xhr);
                }
            });
        });
    </script>
{{-- CREATE MODAL --}}
    <script>
        $('#createVehiculoModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Botón que activó el modal
            var modal = $(this); // Define modal como el modal actual
            var url = "{{ route('admin.vehiculos.create', ':id') }}"; // Corrige la ruta aquí
            url = url.replace(':id', button.data('id')); // Reemplaza ':id' con el ID del vehículo

            $.ajax({
                url: url, // URL de la API o endpoint
                method: 'GET',
                success: function(data) {// Obtener el select de profesor
                    var select = modal.find('#profesor_select');
                    if (data.vehiculo) {// Establecer el valor seleccionado del profesor, si existe
                        select.val(data.vehiculo.profesor_id); 
                    }
                },
                error: function(xhr) {
                    console.error('Error al cargar los datos del vehículo:', xhr);
                }
            });
        });
    </script>
    {{-- VALIDACIÓN CREATE VEHICULO --}}
<script>
    $(document).ready(function() {
        $('#createFormVehiculo').on('submit', function(e) {
            let valido = true;
            let mensajes = [];

            // limpiar errores previos
            $('#createVehiculoModal .text-danger').remove();

            // Validar placa
            let placa = $('#createFormVehiculo input[name="placa"]').val().trim();
            if (placa === "") {
                valido = false;
                mensajes.push("La placa es obligatoria");
                $('#createFormVehiculo input[name="placa"]').after('<small class="text-danger">La placa es obligatoria</small>');
            }

            // Validar modelo
            let modelo = $('#createFormVehiculo input[name="modelo"]').val().trim();
            if (modelo === "") {
                valido = false;
                $('#createFormVehiculo input[name="modelo"]').after('<small class="text-danger">El modelo es obligatorio</small>');
            }

            // Validar tipo (select)
            let tipo = $('#createFormVehiculo select[name="tipo_id"]').val();
            if (!tipo) {
                valido = false;
                $('#createFormVehiculo select[name="tipo_id"]').after('<small class="text-danger">Debe seleccionar un tipo</small>');
            }

            // Validar profesor (select)
            let profesor = $('#createFormVehiculo select[name="profesor_id"]').val();
            if (!profesor) {
                valido = false;
                $('#createFormVehiculo select[name="profesor_id"]').after('<small class="text-danger">Debe seleccionar un profesor</small>');
            }

            // si no es válido, detener envío
            if (!valido) {
                e.preventDefault();
            }
        });
    });
</script>

@endsection
