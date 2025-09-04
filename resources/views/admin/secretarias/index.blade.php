@extends('adminlte::page')

@section('title', 'Dashboard')
@section('css')
@stop
@section('content_header')
    <h1>Sistema de reservas </h1>
@stop

@section('content')
    <div class="row">
        <h1>Listado de secretarias</h1>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Usuarios registrados</h3>
                    <div class="card-tools">
                        <a class="btn btn-secondary" data-toggle="modal" data-target="#createModal">Registrar
                            <i class="bi bi-plus-circle-fill"></i>
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    {{-- @if ($info = Session::get('info')) --}}
                    @if (session('info'))
                        <div class="alert alert-success"><strong>{{ $info }}</strong></div>
                    @endif
                    <table id="secretarias" class="table table-striped table-bordered table-hover table-sm">
                        <thead class="thead-dark">
                            <tr>
                                <th>Nro</th>
                                <th>Nombres</th>
                                <th>Apellidos</th>
                                <th>Email</th>
                                <th>Celular</th>
                                <th>Fecha de Nacimiento</th>
                                <th>Direccion</th>
                                <th>Email</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $contador = 1; ?>
                            @foreach ($secretarias as $secretaria)
                                <tr>
                                    <td scope="row">{{ $contador++ }}</td>
                                    <td scope="row">{{ $secretaria->nombres }}</td>
                                    <td scope="row">{{ $secretaria->apellidos }}</td>
                                    <td scope="row">{{ $secretaria->cc }}</td>
                                    <td scope="row">{{ $secretaria->celular }}</td>
                                    <td scope="row">{{ $secretaria->fecha_nacimiento }}</td>
                                    <td scope="row">{{ $secretaria->direccion }}</td>
                                    <td scope="row">{{ $secretaria->user->email }}</td>
                                    <td scope="row">
                                        <div class="btn-group" role="group" aria-label="basic example">
                                            {{-- button SHOW --}}
                                            <a href="#" class="btn btn-primary" data-id="{{ $secretaria->id }}"
                                                data-toggle="modal" data-target="#showModal"> <i class="fas fa-eye"></i></a>
                                            {{-- button EDIT --}}
                                            <a href="#" class="btn btn-warning btn-sm mr-1"
                                                data-id="{{ $secretaria->id }}" data-toggle="modal"
                                                data-target="#editModal" title="Editar"> <i class="fas fa-edit"></i></a>

                                            {{-- <form id="delete-form-{{ $secretaria->id }}" action="{{ route('admin.secretarias.destroy', $secretaria->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $secretaria->id }})"><i class="fas fa-trash"></i></button>
                                            </form> --}}

                                            <div class="text-center">
                                                <form id="delete-form-{{ $secretaria->id }}"
                                                    action="{{ route('admin.secretarias.toggleStatus', $secretaria->user->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PATCH') <!-- Laravel permite cambios parciales con PATCH -->
                                                    <button type="submit"
                                                        class="btn {{ $secretaria->user->status ? 'btn-success' : 'btn-danger' }}">
                                                        {!! $secretaria->user->status
                                                            ? '<i class="fa-solid fa-square-check"></i>'
                                                            : '<i class="fa-solid fa-circle-xmark"></i>' !!}
                                                    </button>
                                                </form>
                                            </div>
                                        </div>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @include('admin.secretarias.create')
                    @include('admin.secretarias.edit')
                    @include('admin.secretarias.show')

                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    {{-- DATA TABLE --}}
    <script>
        new DataTable('#secretarias', {
            responsive: true,
            autoWidth: false, //no le vi la funcionalidad
            dom: 'Bfrtip', // Añade el contenedor de botones
            buttons: [{
                extend: 'collection',
                text: 'Reportes',
                orientation: 'landscape',
                buttons: ['copy', 'csv', 'excel', 'pdf', 'print',
                    'colvis'
                ], // Botones que aparecen en la imagen
            }, ],
            "language": {
                "decimal": "",
                "emptyTable": "No hay datos disponibles en la tabla",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ secretarias",
                "infoEmpty": "Mostrando 0 a 0 de 0 secretarias",
                "infoFiltered": "(filtrado de _MAX_ secretarias totales)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ secretarias",
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
        });

        function confirmDelete(id) {
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¿Deseas eliminar este secretaria?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Si el usuario confirma, se envía el formulario.
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }
    </script>
    <!-- EDIT MODAL -->
    <script>
        $('#editModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var modal = $(this);

            var url = "{{ route('admin.secretarias.edit', ':id') }}".replace(':id', id);

            $.ajax({
                url: url,
                method: 'GET',
                success: function(data) {
                    // Cambiar la acción del form
                    var formAction = "{{ route('admin.secretarias.update', ':id') }}".replace(':id',
                        data.id);
                    modal.find('#editForm').attr('action', formAction);

                    // Llenar los campos
                    modal.find('#edit-nombres').val(data.nombres);
                    modal.find('#edit-apellidos').val(data.apellidos);
                    modal.find('#edit-cc').val(data.cc);
                    modal.find('#edit-celular').val(data.celular);
                    modal.find('#edit-direccion').val(data.direccion);
                    modal.find('#edit-email').val(data.user.email);
                    // 👇 convertir fecha de DD/MM/YYYY → YYYY-MM-DD
                    if (data.fecha_nacimiento) {
                        let partes = data.fecha_nacimiento.split('/');
                        if (partes.length === 3) {
                            let fechaISO =
                                `${partes[2]}-${partes[1].padStart(2, '0')}-${partes[0].padStart(2, '0')}`;
                            modal.find('#edit-fecha_nacimiento').val(fechaISO);
                        }
                    }

                },
                error: function(xhr) {
                    console.error('Error al cargar los datos de la secretaria:', xhr);
                }
            });
        });
    </script> 
    {{-- VALIDATION MODAL --}}
    <script>
        $('#createForm').on('submit', function(e) {
            e.preventDefault(); // evita el cierre automático

            let form = $(this);
            let actionUrl = form.attr('action');

            $.ajax({
                url: actionUrl,
                method: 'POST',
                data: form.serialize(),
                success: function(response) {
                    toastr.success("Registro exitoso");
                    $('#createModal').modal('hide'); // aquí sí cierras manualmente si quieres
                    form[0].reset();   // limpiar formulario
                    location.reload(); // refresca la vista y la tabla se repuebla desde Blade
                    // $('#secretarias').DataTable().ajax.reload(); // refrescar tabla sin recargar la página
                },
                error: function(xhr) {
                    if (xhr.status === 422) { // errores de validación Laravel
                        let errors = xhr.responseJSON.errors;
                        $.each(errors, function(key, messages) {
                            toastr.error(messages[0]);
                        });
                    } else {
                        toastr.error("Ocurrió un error inesperado");
                    }
                }
            });
        });
    </script>

@stop
