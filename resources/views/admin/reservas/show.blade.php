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
                    @if ($info = Session::get('info'))
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
                                @can('admin.event_delete')
                                    <th>Acciones</th>
                                @endcan

                            </tr>
                        </thead>
                        <tbody>
                            <?php $contador = 1; ?>
                            @foreach ($events as $evento)
                                <tr>
                                    <td scope="row">{{ $contador++ }}</td>
                                    <td scope="row">{{ $evento->profesor->nombres . ' ' . $evento->profesor->apellidos }}
                                    </td>
                                    <td scope="row">{{ $evento->cliente->nombres . ' ' . $evento->cliente->apellidos }}
                                    </td>

                                    <td scope="row" class="text-center">{{ $evento->curso->nombre }}</td>
                                    <td scope="row" class="text-center">
                                        {{ \Carbon\Carbon::parse($evento->start)->format('Y-m-d') }}</td>
                                    <td scope="row" class="text-center">
                                        {{ \Carbon\Carbon::parse($evento->start)->format('H:i') }}</td>
                                    <td scope="row" class="text-center">
                                        {{ \Carbon\Carbon::parse($evento->end)->format('H:i') }}</td>
                                    {{-- <td scope="row" class="text-center">{{ $evento->created_at }}</td> --}}
                                    {{-- <td scope="row" class="text-center">{{ $evento->id }}</td> --}}
                                    @can('admin.event_delete')
                                        <td scope="row">
                                            {{-- <a href=""  class="btn btn-info btn-sm">Ver</a> --}}
                                            <div class="btn-group" role="group" aria-label="basic example">
                                                <form id="delete-form-{{ $evento->id }}"
                                                    action="{{ route('admin.events.destroy', $evento->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-danger"
                                                        onclick="confirmDelete({{ $evento->id }})"><i
                                                            class="fas fa-trash"></i></button>
                                                </form>
                                            </div>
                                        </td>
                                    @endcan

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <a class="btn btn-secondary" href="/admin">Regresar</a>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    
    
    

    <!-- Buttons JS -->
    
    
    
    
    
    
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
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print', 'colvis' // Botones que aparecen en la imagen
            ],
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
        @if (session('info') && session('icono'))
            Swal.fire({
                title: "{{ session('title') }}!",
                text: "{{ session('info') }}",
                icon: "{{ session('icono') }}"
            });
        @endif
    </script>
@stop
