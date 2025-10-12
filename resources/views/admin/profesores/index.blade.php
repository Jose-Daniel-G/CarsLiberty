@extends('adminlte::page')

@section('title', 'Dashboard')
@section('css') 
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
                                                <button type="button" class="btn btn-danger btn-delete"
                                                    data-id="{{ $profesor->id }}"
                                                    data-text="¿Estás seguro de eliminar este profesor?">
                                                    <i class="fas fa-trash"></i>
                                                </form>
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
        $(document).ready(function() {

            // Destruir solo si ya existe la instancia jQuery DataTable
            if ($.fn.DataTable.isDataTable('#profesores')) {
                $('#profesores').DataTable().clear().destroy();
            }

            // Inicialización segura
            $('#profesores').DataTable({
                responsive: true,
                scrollX: true,
                autoWidth: false,
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'collection',
                        text: 'Reportes',
                        className: 'btn btn-primary', // Aplica clase Bootstrap
                buttons: [{extend: 'copyHtml5',text: '<i class="bi bi-clipboard-check"></i> Copiar'}, // Added btn-sm for better consistency
                          {extend: 'csvHtml5',text: '<i class="bi bi-filetype-csv"></i> CSV'},
                          {extend: 'excelHtml5',text: '<i class="bi bi-file-earmark-excel"></i> Excel'},
                          {extend: 'pdfHtml5',text: '<i class="bi bi-filetype-pdf"></i> PDF'},
                          {extend: 'print',text: '<i class="bi bi-printer"></i> Imprimir' },
                          {extend: 'colvis'}],
                    }
                ],
                language: {
                    decimal: "",
                    emptyTable: "No hay datos disponibles en la tabla",
                    info: "Mostrando _START_ a _END_ de _TOTAL_ profesores",
                    lengthMenu: "Mostrar _MENU_ profesores",
                    search: "Buscar:",
                    paginate: { "first": "Primero","last": "Último","next": "Siguiente","previous": "Anterior" }
                }
            });
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
