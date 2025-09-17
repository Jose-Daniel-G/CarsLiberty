@extends('adminlte::page')

@section('title', 'Roles')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Roles</h1>
    </div>
@stop

@section('content')
    <x-message></x-message>

    <div class="card-body">
        <div class="card card-outline card-primary">

            <div class="card-header">
                <div class="card-tools">
                    @can('roles.create')
                        <a class="btn btn-secondary" data-toggle="modal" data-target="#createModal">Registrar
                            <i class="bi bi-plus-circle-fill"></i>
                        </a>
                    @endcan
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="roles" class="table table-striped table-bordered table-hover table-sm">
                        <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Permisos</th>
                                <th>Creación</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($roles as $role)
                                <tr>
                                    <td>{{ $role->id }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>{{ $role->permissions->pluck('name')->implode(', ') }}</td>
                                    <td>{{ $role->created_at->format('d M, Y') }}</td>
                                    <td class="d-flex justify-content-center">
                                        @can('roles.edit')
                                            {{-- button EDIT --}}
                                            <a href="#" class="btn btn-warning btn-sm mr-1" data-id="{{ $role->id }}"
                                                data-toggle="modal" data-target="#editModal" title="Editar"> <i
                                                    class="fas fa-edit"></i></a>
                                        @endcan

                                        {{-- @can('roles.delete') --}}
                                        <form id="delete-form-{{ $role->id }}"
                                            action="{{ route('admin.roles.destroy', $role->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger btn-sm" title="Eliminar"
                                                onclick="confirmDelete({{ $role->id }})">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                        {{-- @endcan --}}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">No hay roles disponibles.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    @include('admin.roles.create')
                    @include('admin.roles.edit')
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    {{-- Estilos adicionales si necesitas --}}
@stop

@section('js')
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¿Estás seguro de que deseas eliminar este rol?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }
        new DataTable('#roles', {
            responsive: true,
            scrollX: true,
            autoWidth: false,
            dom: 'Bfrtip', // Añade el contenedor de botones
            buttons: ['copy', 'csv', 'excel', 'pdf', 'print', 'colvis'], // Botones que aparecen en la imagen
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
    <script>
        $('#editModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var modal = $(this);

            var url = "{{ route('admin.roles.edit', ':id') }}".replace(':id', id);

            $.ajax({
                url: url,
                method: 'GET',
                success: function(data) {
                    var formAction = "{{ route('admin.roles.update', ':id') }}".replace(':id', data.role
                        .id);
                    modal.find('#editForm').attr('action', formAction);
                    modal.find('#edit-name').val(data.role.name);

                    var container = modal.find('#rolesContainer');
                    container.empty();

                    // row declarado una sola vez
                    var row = $('<div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-2"></div>');

                    // Si hasPermissions son ids (recomendado)
                    // convertir a strings para evitar problemas de tipo si lo deseas:
                    var hasPerms = data.hasPermissions.map(String);

                    data.permissions.forEach(function(permission) {
                        var checked = hasPerms.includes(String(permission.id)) ? 'checked' : '';
                        var html = `
                    <div class="col">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="permission[]"
                                value="${permission.name}" id="permission_${permission.id}" ${checked}>
                            <label class="form-check-label" for="permission_${permission.id}">
                                ${permission.name}
                            </label>
                        </div>
                    </div>
                `;
                        row.append(html);
                    });

                    container.append(row);
                },
                error: function(xhr) {
                    console.error('Error al cargar los datos del rol:', xhr);
                }
            });
        });
    </script>
@stop
