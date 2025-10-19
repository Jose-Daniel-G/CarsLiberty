@extends('adminlte::page')

@section('title', 'Dashboard')
@section('css')
@stop
@section('content_header')
    <h1>Listado de cursos</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Cursos registrados</h3>
                    <div class="card-tools">
                        <a class="btn btn-secondary" data-toggle="modal" data-target="#createCursoModal">Registrar
                            <i class="bi bi-plus-circle-fill"></i>
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    @if (session('info'))
                        <div class="alert alert-success"><strong>{{ session('info') }}</strong></div>
                    @endif
                    <table id="cursos" class="table table-striped table-bordered table-hover table-sm">
                        <thead class="thead-dark">
                            <tr>
                                <th>Nro</th>
                                <th>Curso</th>
                                <th>Horas</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $contador = 1; ?>
                            @foreach ($cursos as $curso)
                                <tr>
                                    <td scope="row">{{ $contador++ }}</td>
                                    <td scope="row">{{ $curso->nombre }}</td>
                                    <td scope="row">{{ $curso->horas_requeridas }}</td>
                                    <td scope="row">
                                        <form id="disable-form-{{ $curso->id }}"
                                            action="{{ route('admin.cursos.toggleStatus', $curso->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH') <!-- Laravel permite cambios parciales con PATCH -->
                                            <button type="submit"
                                                class="btn {{ $curso->estado ? 'btn-success' : 'btn-danger' }}">
                                                {!! $curso->estado
                                                    ? '<i class="fa-solid fa-square-check"></i>'
                                                    : '<i class="fa-solid fa-circle-xmark"></i>' !!}
                                            </button>
                                        </form>
                                    </td>
                                    <td scope="row"> 
                                        <a href="#" class="btn btn-warning btn-sm mr-1" data-id="{{ $curso->id }}"
                                        data-toggle="modal" data-target="#editCursoModal" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <form id="delete-form-{{ $curso->id }}" action="{{ route('admin.cursos.destroy', $curso->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                                <button type="button" class="btn btn-danger btn-delete"
                                                    data-id="{{ $curso->id }}"
                                                    data-text="¿Estás seguro de que deseas eliminar este curso?">
                                                    <i class="fas fa-trash"></i>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @include('admin.cursos.create')
                    @include('admin.cursos.edit')
                    {{-- @include('admin.cursos.show') --}}
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')

<script>
    $('#editCursoModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); // botón que abre el modal
        var id = button.data('id'); // ID del curso
        var modal = $(this);

        var url = "{{ route('admin.cursos.edit', ':id') }}".replace(':id', id);

        $.ajax({
            url: url,
            method: 'GET',
            success: function(data) {
                // Cambiar la URL del form
                var formAction = "{{ route('admin.cursos.update', ':id') }}".replace(':id', data.id);
                modal.find('#editForm').attr('action', formAction);

                // Llenar los campos
                modal.find('#edit-nombre').val(data.nombre);
                modal.find('#edit-descripcion').val(data.descripcion);
                modal.find('#edit-horas').val(data.horas_requeridas);
                var estadoTexto = (data.estado == 1 || data.estado == 'A') ? 'Activo' : 'Inactivo';
                modal.find('#edit-estado').text(estadoTexto);
            },
            error: function(xhr) {
                console.error('Error al cargar los datos del curso:', xhr);
            }
        });
    });
</script>
    <script>

        new DataTable('#cursos', {
            responsive: true,
            scrollX: true,
            autoWidth: false,  
            dom: 'Bfrtip', // Añade el contenedor de botones
            buttons: [{extend: 'copyHtml5',text: '<i class="bi bi-clipboard-check"></i> Copiar',className: 'btn btn-sm btn-success'}, // Added btn-sm for better consistency
                        {extend: 'csvHtml5',text: '<i class="bi bi-filetype-csv"></i> CSV',className: 'btn btn-sm btn-warning'},
                        {extend: 'excelHtml5',text: '<i class="bi bi-file-earmark-excel"></i> Excel',className: 'btn btn-sm btn-secondary'},
                        {extend: 'pdfHtml5',text: '<i class="bi bi-filetype-pdf"></i> PDF',className: 'btn btn-sm btn-danger'},
                        {extend: 'print',text: '<i class="bi bi-printer"></i> Imprimir',className: 'btn btn-sm btn-dark' },
                        {extend: 'colvis'}],
            "language": {
                "decimal": "",
                "emptyTable": "No hay datos disponibles en la tabla",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ cursos",
                "infoEmpty": "Mostrando 0 a 0 de 0 cursos",
                "infoFiltered": "(filtrado de _MAX_ cursos totales)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ cursos",
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
            }

        }); 
    </script>
@stop
