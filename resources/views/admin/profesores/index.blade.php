@extends('adminlte::page')

@section('title', 'Dashboard')
@section('css')
    <!-- DataTables core CSS --> <!-- DataTables Buttons extension CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css"> --}}
    {{-- Add here extra stylesheets --}}
    {{-- NOTA: DESEO TOMAR ESTOS ESTILOS PARA LOS BOTONES DE LA TABLA, MAS NO HE PODIDO --}}
    {{-- <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}"> --}}
@stop
@section('content_header')
    <h1>Listado de profesores</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Profesores registrados</h3>
                    <div class="card-tools">
                        <a class="btn btn-secondary" data-toggle="modal" data-target="#createProfesorModal">Registrar
                            <i class="bi bi-plus-circle-fill"></i>
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    @if ($info = Session::get('info'))
                        <div class="alert alert-success"><strong>{{ $info }}</strong></div>
                    @endif
                    <table id="profesores" class="table table-striped table-bordered table-hover table-sm">
                        <thead class="thead-dark">
                            <tr>
                                <th>Nro</th>
                                <th>Nombres y Apellidos</th>
                                <th>Telefono</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $contador = 1; ?>
                            @foreach ($profesores as $profesor)
                                <tr>
                                    <td scope="row">{{ $contador++ }}</td>
                                    <td scope="row">{{ $profesor->nombres . ' ' . $profesor->apellidos }}</td>
                                    <td scope="row">{{ $profesor->telefono }}</td>
                                    <td scope="row">
                                        <div class="text-center">
                                            <form id="disable-form-{{ $profesor->id }}"
                                                action="{{ route('admin.profesors.toggleStatus', $profesor->user->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('PATCH') <!-- Laravel permite cambios parciales con PATCH -->
                                                <button type="submit"
                                                    class="btn {{ $profesor->user->status ? 'btn-success' : 'btn-danger' }}">
                                                    {!! $profesor->user->status
                                                        ? '<i class="fa-solid fa-square-check"></i>'
                                                        : '<i class="fa-solid fa-circle-xmark"></i>' !!}
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                    <td scope="row">
                                        <div class="btn-group" role="group" aria-label="basic example">
                                            <a href="#" class="btn btn-primary" data-id="{{ $profesor->id }}"
                                                data-toggle="modal" data-target="#showProfesorModal">
                                                <i class="fas fa-eye"></i>
                                            </a>

                                            <a href="#" class="btn btn-warning btn-sm mr-1"
                                                data-id="{{ $profesor->id }}" data-toggle="modal"
                                                data-target="#editProfesorModal" title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form id="delete-form-{{ $profesor->id }}"
                                                action="{{ route('admin.profesores.destroy', $profesor->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-danger"
                                                    onclick="confirmDelete({{ $profesor->id }})">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>

                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @include('admin.profesores.edit')
                    @include('admin.profesores.create')
                    @include('admin.profesores.show')
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')

    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¡No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) { // Si el usuario confirma, se envía el formulario.
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }
        new DataTable('#profesores', {
            "language": {
                "decimal": "",
                "emptyTable": "No hay datos disponibles en la tabla",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ profesores",
                "infoEmpty": "Mostrando 0 a 0 de 0 profesores",
                "infoFiltered": "(filtrado de _MAX_ profesores totales)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ profesores",
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
            responsive: true,
            autoWidth: false, //no le vi la funcionalidad
            dom: 'Bfrtip', // Añade el contenedor de botones
            buttons: [{
                extend: 'collection',
                text: 'Reportes',
                orientation: 'landscape',
                buttons: [{
                    text: 'Copiar',
                    extend: 'copy'
                }, {
                    extend: 'pdf'
                }, {
                    extend: 'csv'
                }, {
                    extend: 'excel'
                }, {
                    text: 'Imprimir',
                    extend: 'print'
                }]
            }, ],

        });
        @if (session('info') && session('icono'))
            Swal.fire({
                title: "{{ session('info') }}",
                text: "{{ session('info') }}",
                icon: "{{ session('icono') }}"
            });
        @endif
    </script>
    <script>
        $('#editProfesorModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var id = button.data('id'); // id del profesor
            var modal = $(this);

            // Ruta edit
            var url = "{{ route('admin.profesores.edit', ':id') }}".replace(':id', id);

            $.ajax({
                url: url,
                method: 'GET',
                success: function(data) {
                    // Cambiar la URL del form update
                    var formAction = "{{ route('admin.profesores.update', ':id') }}".replace(':id',
                        data.id);
                    modal.find('#editProfesorForm').attr('action', formAction);

                    // Rellenar los campos
                    modal.find('#edit-nombres').val(data.nombres);
                    modal.find('#edit-apellidos').val(data.apellidos);
                    modal.find('#edit-telefono').val(data.telefono);
                    modal.find('#edit-email').val(data.user.email);
                },
                error: function(xhr) {
                    console.error('Error al cargar los datos del profesor:', xhr);
                }
            });
        });
    </script>
    <script>
        $('#showProfesorModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Botón que abre el modal
            var id = button.data('id'); // ID del profesor
            var modal = $(this);

            var url = "{{ route('admin.profesores.show', ':id') }}".replace(':id', id);

            $.ajax({
                url: url,
                method: 'GET',
                success: function(data) {
                    // Llenar campos del modal
                    modal.find('#show-profesor-nombre').text(data.nombres + ' ' + data.apellidos);
                    modal.find('#show-profesor-telefono').text(data.telefono);
                    modal.find('#show-profesor-estado').text(data.user.status === 1 ? 'Activo' :
                        'Inactivo');
                },
                error: function(xhr) {
                    console.error('Error al cargar el profesor:', xhr);
                }
            });
        });
    </script>

@stop
