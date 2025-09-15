@extends('adminlte::page')

@section('title', 'JDeveloper')
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.3/css/responsive.bootstrap4.css">
@stop
@section('content_header')
    <h1>Lista de usuarios</h1>
@stop
@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">Usuarios registrados</h3>
            <div class="card-tools">
                <a class="btn btn-secondary" data-toggle="modal" data-target="#createModal">Registrar<i
                        class="bi bi-plus-circle-fill"></i></a>{{-- button create --}}
            </div>
        </div>
        <div class="card-body">
            <table id="usuarios" class="table table-striped table-bordered table-hover table-sm">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th class="text-center"> Acciones </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td class="text-center">
                                {{-- button EDIT --}}
                                <a href="#" class="btn btn-warning btn-sm mr-1" data-id="{{ $user->id }}"
                                    data-toggle="modal" data-target="#editModal" title="Editar"> <i
                                        class="fas fa-edit"></i></a>

                                @can('permissions.delete')
                                    <form action="{{ route('users.toggleStatus', $user->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('PATCH') <!-- Laravel permite cambios parciales con PATCH -->
                                        <button type="submit" class="btn {{ $user->status ? 'btn-danger' : 'btn-success' }}">
                                            {!! $user->status ? '<i class="fa-solid fa-circle-xmark"></i>' : '<i class="fa-solid fa-square-check"></i>' !!}
                                        </button>
                                    </form>
                                @endcan

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">No hay permisos registrados.</td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
            @include('admin.users.create')
            @include('admin.users.edit')
        </div>

    </div>
@stop
@section('css')
@stop
@section('js')
    <script>
        new DataTable('#usuarios', {
            responsive: true,scrollX: true, 
            autoWidth: false, //no le vi la funcionalidad
            dom: 'Bfrtip', // Añade el contenedor de botones
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print', 'colvis' // Botones que aparecen en la imagen
            ],
            "language": {
                "decimal": "",
                "emptyTable": "No hay datos disponibles en la tabla",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ entradas",
                "infoEmpty": "Mostrando 0 a 0 de 0 entradas",
                "infoFiltered": "(filtrado de _MAX_ entradas totales)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ entradas",
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

        // @if (session('info') && session('icono'))
        //     Swal.fire({
        //         title: "{{ session('title') }}!",
        //         text: "{{ session('info') }}",
        //         icon: "{{ session('icono') }}"
        //     });
        // @endif
    </script>
<script>
    $('#editModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var userId = button.data('id');
        var modal = $(this);

        var url = "{{ route('admin.users.edit', ':id') }}".replace(':id', userId);

        $.ajax({
            url: url,
            method: 'GET',
            success: function(data) {
                // Set the form's action URL dynamically
                var formAction = "{{ route('admin.users.update', ':id') }}".replace(':id', data.user.id);
                modal.find('#editForm').attr('action', formAction);

                // Populate the user's name and email
                modal.find('#edit-name').val(data.user.name);
                modal.find('#edit-email').val(data.user.email);

                // Get the container for roles and clear it
                var rolesContainer = modal.find('#rolesContainer');
                rolesContainer.empty();

                // Loop through all available roles and create checkboxes
                data.roles.forEach(function(role) {
                    // Check if the user has this role
                    var isChecked = data.user.roles.some(userRole => userRole.id === role.id) ? 'checked' : '';

                    // Create the HTML for the checkbox using a template literal
                    var html = `
                        <div class="form-check form-check-inline">
                            <input type="checkbox" class="form-check-input" name="roles[]"
                                value="${role.id}" id="role_${role.id}" ${isChecked}>
                            <label class="form-check-label" for="role_${role.id}">
                                ${role.name}
                            </label>
                        </div>
                    `;
                    rolesContainer.append(html);
                });
            },
            error: function(xhr, status, error) {
                console.error("Error fetching user data:", error);
            }
        });
    });
</script>

@stop
