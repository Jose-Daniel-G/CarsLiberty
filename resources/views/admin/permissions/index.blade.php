@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Sistema de reservas</h1>
@stop

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ __('Permissions') }}</h3>
            @can('permissions.create')
                <div class="card-tools">
                    <a class="btn btn-secondary" data-toggle="modal" data-target="#createModal">Registrar<i
                            class="bi bi-plus-circle-fill"></i></a>{{-- button create --}}
                </div>
            @endcan
        </div>

        <x-message></x-message>{{-- JD  resources/views/components --}}
        <div class="card-body">
            <table id="permissions" class="table table-striped table-bordered table-hover table-sm">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Creación</th>
                        <th class="text-center">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($permissions as $permission)
                        <tr>
                            <td>{{ $permission->id }}</td>
                            <td>{{ $permission->name }}</td>
                            <td>{{ \Carbon\Carbon::parse($permission->created_at)->format('d M, Y') }}</td>
                            <td class="text-center">
                                @can('permissions.edit')
                                    {{-- button EDIT --}}
                                    <a href="#" class="btn btn-warning btn-sm mr-1" data-id="{{ $permission->id }}"
                                        data-toggle="modal" data-target="#editModal" title="Editar"> <i
                                            class="fas fa-edit"></i></a>
                                @endcan
                                @can('permissions.delete')
                                    <form id="delete-form-{{ $permission->id }}"
                                        action="{{ route('admin.permissions.destroy', $permission->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm" title="Eliminar"
                                            onclick="confirmDelete({{ $permission->id }})">
                                            <i class="fas fa-trash"></i>
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
            @include('admin.permissions.create')
            @include('admin.permissions.edit')
        </div>
    </div>
@stop

@section('css')
    {{-- Puedes incluir estilos adicionales si lo deseas --}}
@stop

@section('js')
    <script>
        $('#editModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // botón que abre el modal
            var id = button.data('id'); // ID del curso
            var modal = $(this);

            var url = "{{ route('admin.permissions.edit', ':id') }}".replace(':id', id);

            $.ajax({
                url: url,
                method: 'GET',
                success: function(data) { // Cambiar la URL del form
                    var formAction = "{{ route('admin.permissions.update', ':id') }}".replace(':id',
                        data.permission.id);
                    modal.find('#editForm').attr('action', formAction);
                    modal.find('#edit-name').val(data.permission.name);
                },
                error: function(xhr) {
                    console.error('Error al cargar los datos del curso:', xhr);
                }
            });
        });
    </script>
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¿Estás seguro de que deseas eliminar este curso?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) { document.getElementById('delete-form-' + id).submit();  }
            });
        }
        new DataTable('#permissions', {
            responsive: true,scrollX: true,
            autoWidth: false,
            dom: 'Bfrtip', // Añade el contenedor de botones
            buttons: ['copy', 'csv', 'excel', 'pdf', 'print', 'colvis'], // Botones que aparecen en la imagen
            "language": {
                "decimal": "",
                "emptyTable": "No hay datos disponibles en la tabla",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ permissions",
                "infoEmpty": "Mostrando 0 a 0 de 0 permissions",
                "infoFiltered": "(filtrado de _MAX_ permissions totales)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ permissions",
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
        @if (session('info') && session('icono'))
            Swal.fire({
                title: "{{ session('title') }}!",
                text: "{{ session('info') }}",
                icon: "{{ session('icono') }}"
            });
        @endif
    </script>
@stop
