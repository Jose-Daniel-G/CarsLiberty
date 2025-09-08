@extends('adminlte::page')

@section('title', 'Dashboard')
@section('css')
@stop
@section('content_header')
    <h1>Sistema de reservas </h1>
@stop

@section('content')
    <div class="row">
        <h1>Panel principal</h1>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Usuarios registrados</h3>
                    <div class="card-tools">
                        <a class="btn btn-secondary" data-toggle="modal" data-target="#createClienteModal">Registrar
                            <i class="bi bi-plus-circle-fill"></i>
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    @if ($info = Session::get('info'))
                        <div class="alert alert-success"><strong>{{ $info }}</strong></div>
                    @endif
                    <table id="clientes" class="table table-striped table-bordered table-hover table-sm">
                        <thead class="thead-dark">
                            <tr>
                                <th>Nro</th>
                                <th>Nombres</th>
                                <th>Apellidos</th>
                                <th>cc</th>
                                <th>Direccion</th>
                                <th>Acciones</th>
                                {{-- <th>Email</th> --}}
                                {{-- <th>Fecha de Nacimiento</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            <?php $contador = 1; ?>
                            @foreach ($clientes as $cliente)
                                <tr>
                                    <td scope="row">{{ $contador++ }}</td>
                                    <td scope="row">{{ $cliente->nombres }}</td>
                                    <td scope="row">{{ $cliente->apellidos }}</td>
                                    <td scope="row">{{ $cliente->cc }}</td>
                                    <td scope="row">{{ $cliente->direccion }}</td>
                                    {{-- <td scope="row">{{ $cliente->user->email }}</td> --}}
                                    <td scope="row ">
                                        <div class="btn-group" role="group" aria-label="basic example">

                                            <a href="#" class="btn btn-primary" data-id="{{ $cliente->id }}"
                                                data-toggle="modal" data-target="#showClienteModal">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="#" class="btn btn-warning btn-sm mr-1"
                                                data-id="{{ $cliente->id }}" data-toggle="modal"
                                                data-target="#editClienteModal" title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <div class="text-center">
                                                <form id="delete-form-{{ $cliente->id }}"
                                                    action="{{ route('admin.clientes.toggleStatus', $cliente->user->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PATCH') <!-- Laravel permite cambios parciales con PATCH -->
                                                    <button type="submit"
                                                        class="btn {{ $cliente->user->status ? 'btn-success' : 'btn-danger' }}">
                                                        {!! $cliente->user->status
                                                            ? '<i class="fa-solid fa-square-check"></i>'
                                                            : '<i class="fa-solid fa-circle-xmark"></i>' !!}
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            {{-- <form id="delete-form-{{ $cliente->id }}" action="{{ route('admin.clientes.destroy', $cliente->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $cliente->id }})"><i     class="fas fa-trash"></i></button>
                            </form> --}}
                        </tbody>
                    </table>
                    </table>
                    @include('admin.clientes.create')
                    @include('admin.clientes.edit')
                    @include('admin.clientes.show')
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        new DataTable('#clientes', {
            responsive: true,
            autoWidth: false, //no le vi la funcionalidad
            dom: 'Bfrtip', // Añade el contenedor de botones
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print', 'colvis'], // Botones que aparecen en la imagen
            "language": {
                "decimal": "",
                "emptyTable": "No hay datos disponibles en la tabla",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ clientes",
                "infoEmpty": "Mostrando 0 a 0 de 0 clientes",
                "infoFiltered": "(filtrado de _MAX_ clientes totales)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ clientes",
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
        $('#editClienteModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var modal = $(this);

            // Ruta del endpoint de edición
            var url = "{{ route('admin.clientes.edit', ':id') }}".replace(':id', id);

            $.ajax({
                url: url,
                method: 'GET',
                success: function(response) {
                    // Rellenar los campos del cliente
                    modal.find('#editClienteForm').attr('action',"{{ route('admin.clientes.update', ':id') }}".replace(':id', response.cliente.id));
                    modal.find('#edit-nombres').val(response.cliente.nombres);
                    modal.find('#edit-apellidos').val(response.cliente.apellidos);
                    modal.find('#edit-cc').val(response.cliente.cc);
                    modal.find('#edit-celular').val(response.cliente.celular);
                    modal.find('#edit-direccion').val(response.cliente.direccion);
                    modal.find('#edit-contacto_emergencia').val(response.cliente.contacto_emergencia);
                    modal.find('#edit-email').val(response.cliente.user.email);
                    modal.find('#edit-observaciones').val(response.cliente.observaciones);

                    // Seleccionar la opción de género
                    modal.find('#edit-genero').val(response.cliente.genero);

                    // Rellenar y seleccionar los checkboxes de los cursos
                    var cursosContainer = modal.find('#cursos-checkboxes');
                    cursosContainer.empty(); // Limpiar checkboxes anteriores

                    // Iterar sobre todos los cursos y crear los checkboxes
                    response.cursos.forEach(function(curso) {
                        var isChecked = response.cursosSeleccionados.includes(curso.id) ?
                            'checked' : '';
                        var checkboxHtml = `
                            <div class="col-md-6 col-lg-4">
                                <div class="form-check">
                                    <input type="checkbox" name="cursos[]" value="${curso.id}"
                                        class="form-check-input" id="edit-curso-${curso.id}" ${isChecked}>
                                    <label class="form-check-label" for="edit-curso-${curso.id}">
                                        ${curso.nombre}
                                    </label>
                                </div>
                            </div>`;
                        cursosContainer.append(checkboxHtml);
                    });
                },
                error: function(xhr) {
                    console.error('Error al cargar los datos del cliente:', xhr);
                    // Opcional: mostrar un mensaje de error al usuario
                    alert('No se pudieron cargar los datos del cliente. Por favor, intente de nuevo.');
                }
            });
        });
        // function confirmDelete(id) {
        //     Swal.fire({
        //         title: '¿Estás seguro?',
        //         text: "¿Estás seguro de que deseas eliminar este cliente?",
        //         icon: 'warning',
        //         showCancelButton: true,
        //         confirmButtonColor: '#3085d6',
        //         cancelButtonColor: '#d33',
        //         confirmButtonText: 'Sí, eliminar',
        //         cancelButtonText: 'Cancelar'
        //     }).then((result) => {
        //         if (result.isConfirmed) {
        //             // Si el usuario confirma, se envía el formulario.
        //             document.getElementById('delete-form-' + id).submit();
        //         }
        //     });
        // }
    </script>
@stop
