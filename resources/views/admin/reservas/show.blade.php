@extends('adminlte::page')

@section('title', 'Dashboard')
@section('css')
@stop
@section('content_header')
    <h1>Listado de reservas</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Reservas registradas</h3>
                </div>

                <div class="card-body">
                    @if (session('info') && session('icono'))
                        <div class="alert alert-success"><strong>{{ $info }}</strong></div>
                    @endif
                    <table id="reservas" class="table table-striped table-bordered table-hover table-sm">
                        <thead class="thead-dark">
                            <tr>
                                <th>Nro</th>
                                <th>Profesor</th>
                                <th>Estudiante</th>
                                <th>Curso</th>
                                <th>Fecha de reserva</th>
                                <th>Hora de inicio</th>
                                <th>Hora de fin</th>
                                {{-- <th>Fecha y hora de registro</th> --}}
                                @can('admin.agendas.destroy')
                                    <th>Acciones</th>
                                @endcan

                            </tr>
                        </thead>
                        <tbody>
                            <?php $contador = 1; ?>
                            @foreach ($agendas as $agenda)
                                <tr>
                                    <td scope="row">{{ $contador++ }}</td>
                                    <td scope="row">{{ $agenda->profesor->nombres . ' ' . $agenda->profesor->apellidos }}</td>
                                    <td scope="row">{{ $agenda->cliente->nombres . ' ' . $agenda->cliente->apellidos }}</td>
                                    <td scope="row" class="text-center">{{ $agenda->curso->nombre }}</td>
                                    <td scope="row" class="text-center">{{ $agenda->start->format('d M, Y') }}</td>
                                    <td scope="row" class="text-center">{{ $agenda->start->format('H:i') }}</td>
                                    <td scope="row" class="text-center">{{ $agenda->end->format('H:i') }}</td>
                                    {{-- <td scope="row" class="text-center">{{ $agenda->created_at }}</td> --}}
                                    {{-- <td scope="row" class="text-center">{{ $agenda->id }}</td> --}}


                                    @can('admin.agendas.destroy')
                                        <td scope="row">
                                            <div class="btn-group" role="group" aria-label="basic example">
                                                {{-- button EDIT --}}
                                                <a href="#" class="btn btn-warning btn-sm mr-1"
                                                    data-id="{{ $agenda->id }}" data-toggle="modal" data-target="#editModal"
                                                    title="Editar"> <i class="fas fa-edit"></i></a>
                                                {{-- <a href=""  class="btn btn-info btn-sm">Ver</a> --}}
                                                <div class="btn-group" role="group" aria-label="basic example">
                                                    <form id="delete-form-{{ $agenda->id }}"
                                                        action="{{ route('admin.agendas.destroy', $agenda->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-danger"
                                                            onclick="confirmDelete({{ $agenda->id }})"><i
                                                                class="fas fa-trash"></i></button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    @endcan
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <a href="{{ url()->previous() }}" class="btn btn-secondary">Regresar</a>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')

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
                if (result.isConfirmed) {
                    // Si el usuario confirma, se envía el formulario.
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }
        new DataTable('#reservas', {
            responsive: true,
            autoWidth: false, //no le vi la funcionalidad
            dom: 'Bfrtip', // Añade el contenedor de botones
            buttons: [{
                extend: 'collection',
                text: 'Reportes',
                orientation: 'landscape',
                buttons: [{extend: 'copyHtml5',text: '<i class="bi bi-clipboard-check"></i> Copiar'}, // Added btn-sm for better consistency
                          {extend: 'csvHtml5',text: '<i class="bi bi-filetype-csv"></i> CSV'},
                          {extend: 'excelHtml5',text: '<i class="bi bi-file-earmark-excel"></i> Excel'},
                          {extend: 'pdfHtml5',text: '<i class="bi bi-filetype-pdf"></i> PDF'},
                          {extend: 'print',text: '<i class="bi bi-printer"></i> Imprimir' },
                          {extend: 'colvis'}],
            }, ],
            "language": {
                "decimal": "",
                "emptyTable": "No hay datos disponibles en la tabla",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ reservas",
                "infoEmpty": "Mostrando 0 a 0 de 0 reservas",
                "infoFiltered": "(filtrado de _MAX_ reservas totales)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ reservas",
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
