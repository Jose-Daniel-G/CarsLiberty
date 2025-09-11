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
                                <th>email</th>
                                <th>Direccion</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>

                    @include('admin.clientes.create')
                    @include('admin.clientes.edit')
                    {{-- @include('admin.clientes.show') --}}
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        $(function () {
            $('#clientes').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                autoWidth: false,
                ajax: '{{ route("admin.clientes.index") }}',
                columns: [{ data: 'id', name: 'id' },
                        { data: 'nombres', name: 'nombres' },
                        { data: 'apellidos', name: 'apellidos' },
                        { data: 'cc', name: 'cc' },
                        { data: 'user.email', name: 'user.email' },
                        { data: 'direccion', name: 'direccion' },
                        { data: 'action', name: 'action', orderable: false, searchable: false }],
                dom: 'Bfrtip',
                buttons: ['copy', 'csv', 'excel', 'pdf', 'print', 'colvis'],
                language: {
                    decimal: "",
                    emptyTable: "No hay datos disponibles en la tabla",
                    info: "Mostrando _START_ a _END_ de _TOTAL_ clientes",
                    infoEmpty: "Mostrando 0 a 0 de 0 clientes",
                    infoFiltered: "(filtrado de _MAX_ clientes totales)",
                    lengthMenu: "Mostrar _MENU_ clientes",
                    loadingRecords: "Cargando...",
                    search: "Buscar:",
                    zeroRecords: "No se encontraron registros coincidentes",
                    paginate: { first: "Primero", last: "Último", next: "Siguiente", previous: "Anterior"}
                }
            });
        });

        $('#editClienteModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var modal = $(this);

            var url = "{{ route('admin.clientes.edit', ':id') }}".replace(':id', id);

            $.ajax({
                url: url,
                method: 'GET',
                success: function(response) {
                    // Rellenar los campos del cliente
                    var formAction = "{{ route('admin.clientes.update', ':id') }}".replace(':id',
                        response.cliente.id);
                    modal.find('#editClienteForm').attr('action', formAction);

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
                    alert('No se pudieron cargar los datos del cliente. Por favor, intente de nuevo.');
                }
            });
        });
        $('#editClienteForm').submit(function(e) {
            e.preventDefault();
            var form = $(this);
            var formData = form.serialize() + '&_method=PUT'; // <- importante
            $.ajax({
                url: form.attr('action'),
                method: 'POST',
                data: form.serialize(),
                success: function(response) {
                    $('#editClienteModal').modal('hide');
                    Swal.fire({
                        text: "Cliente actualizado correctamente",
                        icon: "success"
                    });
                    $('#clientes').DataTable().ajax.reload(null, false);
                },
                error: function(xhr) {
                    console.error(xhr);
                    alert('Error al actualizar cliente');
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
