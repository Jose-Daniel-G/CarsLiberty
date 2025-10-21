@extends('adminlte::page')

@section('title', 'CarsLiberty')
@section('css')
    <style>
        .image-wrapper {
            position: relative;
            padding-bottom: 56.25%;
        }

        .image-wrapper img {
            position: absolute;
            object-fit: cover;
            width: 95%;
            height: 80%;
        }

        .image-wrapper img:hover {
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.5);
            transform: scale(1.05);
        }

        /* Sombra más oscura al pasar el cursor / Efecto de zoom al hacer hover */
    </style>
@stop
@section('content_header')
    <h1>Listado de Configuraciones</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary  px-2 py-2">
                <div class="card-body">
                    @if (session('info'))
                        <div class="alert alert-success"><strong>{{ session('info') }}</strong></div>
                    @endif
                    @if ($config)
                        <table id="configuraciones" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Dirección</th>
                                    <th>Teléfono</th>
                                    <th>Email</th>
                                    <th>Logo</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td scope="row">{{ $config->site_name }}</td>
                                    <td scope="row">{{ $config->address }}</td>
                                    <td scope="row">{{ $config->phone }}</td>
                                    <td scope="row">{{ $config->email_contact }}</td>
                                    <td scope="row">
                                        <img src="{{ asset($config->logo) }}" alt="logo" width="100">
                                    </td>
                                    <td scope="row">
                                        <div class="btn-group" role="group" aria-label="basic example">
                                            <a href="{{ route('admin.config.show', $config->id) }}"
                                                class="btn btn-info btn-sm"><i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.config.edit', $config->id) }}"
                                                class="btn btn-success btn-sm"> <i class="fas fa-edit"></i>
                                            </a>
                                            <form id="delete-form-{{ $config->id }}"
                                                action="{{ route('admin.config.destroy', $config->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-danger btn-delete"
                                                    data-id="{{ $config->id }}"
                                                    data-text="¿Deseas eliminar esta configuración?">
                                                    <i class="fas fa-trash"></i>
                                                </button>

                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    @else
                        @include('admin.config.create')
                        <div class="alert alert-danger">
                            No hay configuraciones registradas.
                            <a class="btn btn-secondary" data-toggle="modal" data-target="#createModal">Registrar<i
                                    class="bi bi-plus-circle-fill"></i></a>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
@stop

@section('js')

    <script>
        new DataTable('#configuraciones', {
            responsive: true,
            scrollX: true,
            autoWidth: false,
            dom: 'Bfrtip', // Añade el contenedor de botones
            buttons: ['copy', 'csv', 'excel', 'pdf', 'print', 'colvis'], // Botones que aparecen en la imagen
            "language": {
                "decimal": "",
                "emptyTable": "No hay datos disponibles en la tabla",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Configuraciones",
                "infoEmpty": "Mostrando 0 a 0 de 0 Configuraciones",
                "infoFiltered": "(filtrado de _MAX_ Configuraciones totales)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Configuraciones",
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
            buttons: [{
                extend: 'collection',
                text: 'Reportes',
                orientation: 'landscape',
                buttons: ['copy', 'csv', 'excel', 'pdf', 'print',
                    'colvis'
                ], // Botones que aparecen en la imagen
            }, ],
            initComplete: function() {
                $('.dt-button').css({ // Apply custom styles after initialization
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
    </script>
@stop
