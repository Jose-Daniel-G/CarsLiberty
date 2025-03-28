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
                        <a href="{{ route('admin.secretarias.create') }}" class="btn btn-primary">Registrar
                            {{-- <i class="fa-solid fa-plus"></i> --}}
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    @if ($info = Session::get('info'))
                        <div class="alert alert-success"><strong>{{ $info }}</strong></div>
                    @endif
                    <table id="secretarias" class="table table-striped table-bordered table-hover table-sm">
                        <thead class="thead-dark">
                            <tr>
                                <th>Nro</th>
                                <th>Nombres</th>
                                <th>Apellidos</th>
                                <th>cc</th>
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
                                            <a href="{{ route('admin.secretarias.show', $secretaria->id) }}"
                                                class="btn btn-info btn-sm"><i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.secretarias.edit', $secretaria->id) }}"
                                                class="btn btn-success btn-sm"><i class="fas fa-edit"></i>
                                            </a>
                                            {{-- <form id="delete-form-{{ $secretaria->id }}"
                                                action="{{ route('admin.secretarias.destroy', $secretaria->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-danger"
                                                    onclick="confirmDelete({{ $secretaria->id }})"><i
                                                        class="fas fa-trash"></i></button>
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
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')

    
    
    

    <!-- Buttons JS -->
    
    
    
    
    
    
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
                'colvis'], // Botones que aparecen en la imagen
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
@stop
