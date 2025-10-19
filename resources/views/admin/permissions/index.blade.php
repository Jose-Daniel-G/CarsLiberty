@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
{{-- The content header is left empty as requested --}}
@stop

@section('content')
    <div class="row pt-3">
        <div class="col-12">
            <div class="card card-outline card-primary ">
                <div class="card-header">
                    <h3 class="card-title">{{ __('Permissions') }}</h3>
                    @can('permissions.create')
                        <div class="card-tools">
                            {{-- button create --}}
                            <a class="btn btn-secondary" data-toggle="modal" data-target="#createModal">
                                Registrar<i class="bi bi-plus-circle-fill"></i>
                            </a>
                        </div>
                    @endcan
                </div>

                <x-message></x-message>{{-- JD resources/views/components --}}

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
                                    <td>{{ $permission->created_at->format('d M, Y') }}</td>
                                    <td class="text-center">
                                        @can('permissions.edit')
                                            {{-- button EDIT --}}
                                            <a href="#" class="btn btn-warning btn-sm mr-1"
                                                data-id="{{ $permission->id }}" data-toggle="modal" data-target="#editModal"
                                                title="Editar"> <i class="fas fa-edit"></i></a>
                                        @endcan
                                        @can('permissions.delete')
                                            <form id="delete-form-{{ $permission->id }}"
                                                action="{{ route('admin.permissions.destroy', $permission->id) }}"
                                                method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-danger btn-delete"
                                                    data-id="{{ $permission->id }}"
                                                    data-text="¿Estás seguro de que deseas eliminar este permiso?">
                                                    <i class="fas fa-trash"></i>
                                        </form>
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
                    {{-- Assuming these includes contain the modal HTML for Create and Edit operations --}}
                    @include('admin.permissions.create')
                    @include('admin.permissions.edit')
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    {{-- You can include additional styles here if needed --}}
@stop

@section('js')
    <script>
        $('#editModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // button that opened the modal
            var id = button.data('id'); // permission ID
            var modal = $(this);

            // Construct the URL for fetching the permission data
            var url = "{{ route('admin.permissions.edit', ':id') }}".replace(':id', id);

            $.ajax({
                url: url,
                method: 'GET',
                success: function(data) {
                    // Set the form action URL for update
                    var formAction = "{{ route('admin.permissions.update', ':id') }}".replace(':id', data.permission.id);
                    modal.find('#editForm').attr('action', formAction);
                    modal.find('#edit-name').val(data.permission.name); // Populate the name field
                },
                error: function(xhr) {  // You might want to show a SweetAlert error here
                    console.error('Error al cargar los datos del permiso:', xhr);
                    Swal.fire('Error', 'No se pudieron cargar los datos del permiso.', 'error');
                }
            });
        });

        // --- DataTables Initialization Logic (The Fix) ---
        $(document).ready(function() {
            // **FIXED: Using the jQuery plugin method for compatibility**
            $('#permissions').DataTable({
                responsive: true,
                scrollX: true,
                autoWidth: false,
                dom: 'Bfrtip', // This correctly enables the Buttons extension
                buttons: [{extend: 'copyHtml5',text: '<i class="bi bi-clipboard-check"></i> Copiar',className: 'btn btn-sm btn-success'}, // Added btn-sm for better consistency
                          {extend: 'csvHtml5',text: '<i class="bi bi-filetype-csv"></i> CSV',className: 'btn btn-sm btn-primary'},
                          {extend: 'excelHtml5',text: '<i class="bi bi-file-earmark-excel"></i> Excel',className: 'btn btn-sm btn-secondary'},
                          {extend: 'pdfHtml5',text: '<i class="bi bi-filetype-pdf"></i> PDF',className: 'btn btn-sm btn-danger'},
                          {extend: 'print',text: '<i class="bi bi-printer"></i> Imprimir',className: 'btn btn-sm btn-dark' }
                ],
                "language": {
                    "decimal": "",
                    "emptyTable": "No hay datos disponibles en la tabla",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ permisos", // Corrected "permissions" to "permisos"
                    "infoEmpty": "Mostrando 0 a 0 de 0 permisos",
                    "infoFiltered": "(filtrado de _MAX_ permisos totales)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "Mostrar _MENU_ permisos",
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
        });

    </script> 
@stop
