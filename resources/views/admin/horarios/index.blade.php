@extends('adminlte::page')

@section('title', 'Dashboard')
@section('css')
@stop
@section('content_header')
    <h1>
        Listado de horarios</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Horarios registrados</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.horarios.create') }}" class="btn btn-primary">Registrar
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    @if ($info = Session::get('info'))
                        <div class="alert alert-success"><strong>{{ $info }}</strong></div>
                    @endif
                    <table id="horarios" class="table table-striped table-bordered table-hover table-sm">
                        <thead class="thead-dark">
                            <tr>
                                <th>Nro</th>
                                <th>Profesor</th>
                                {{-- <th>Especialidad</th> --}}
                                <th>Curso</th>
                                <th>Dia de atencion</th>
                                <th>Hora Inicio</th>
                                <th>Hora Fin</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $contador = 1; ?>
                            @foreach ($horarios as $horario)
                                <tr>
                                    <td scope="row">{{ $contador++ }}</td>
                                    <td scope="row">{{ $horario->profesores->first()->nombres ?? '' }}</td>
                                    {{-- <td scope="row">{{ $horario->profesor->especialidad }}</td> --}}
                                    <td scope="row">{{ $horario->cursos->pluck('nombre')->join(', ') }}</td>

                                    <td scope="row">{{ $horario->dia }}</td>
                                    <td scope="row" class="text-center">{{ $horario->hora_inicio }}</td>
                                    <td scope="row" class="text-center">{{ $horario->hora_fin }}</td>
                                    <td scope="row">
                                        <div class="btn-group" role="group" aria-label="basic example">
                                            <a href="{{ route('admin.horarios.show', $horario->id) }}"
                                                class="btn btn-info btn-sm"><i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.horarios.edit', $horario->id) }}"
                                                class="btn btn-success btn-sm"> <i class="fas fa-edit"></i>
                                            </a>
                                            <form id="delete-form-{{ $horario->id }}"
                                                action="{{ route('admin.horarios.destroy', $horario->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-danger"
                                                    onclick="confirmDelete({{ $horario->id }})">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
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
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-4">
                            <h3 class="card-title">Calendario de atencion de Profesores</h3>
                        </div>
                        <div class="col-md-4 d-flex justify-content-end">
                            <label for="curso_id">Cursos </label><b class="text-danger">*</b>
                        </div>
                        <div class="col-md-4">
                            <select name="curso_id" id="curso_select" class="form-control">
                                <option value="" selected disabled>Seleccione una opción</option>
                                @foreach ($cursos as $curso)
                                    <option value="{{ $curso->id }}">
                                        {{ $curso->nombre }} </option>
                                    {{-- {{ $curso->nombre . ' - ' . $curso->ubicacion }} </option> --}}
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-body">

                    <hr>
                    <div id="curso_info"></div>
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
                text: "¡No podrás revertir esto!",
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
            })
        }
        @if (session('info') && session('icon'))
            Swal.fire({
                title: "{{ session('title') }}",
                text: "{{ session('info') }}",
                icon: "{{ session('icon') }}"
            });
        @endif

        // carga contenido de tabla en  curso_info
            $('#curso_select').on('change', function() {
                var curso_id = $('#curso_select').val();
                var url = "{{ route('admin.horarios.show_datos_cursos', ':id') }}";
                url = url.replace(':id', curso_id);

                if (curso_id) {
                    $.ajax({
                        url: url,
                        type: 'GET',
                        success: function(data) {
                            $('#curso_info').html(data);
                        },
                        error: function() {
                            alert('Error al obtener datos del curso');
                        }
                    });
                } else {
                    $('#curso_info').html('');
                }
            });
    </script>

    
    
    

    <!-- Buttons JS -->
    
    
    
    
    
    
    <script>
        new DataTable('#horarios', {
            responsive: true,
            autoWidth: false, //no le vi la funcionalidad
            dom: 'Bfrtip', // Añade el contenedor de botones
            "language": {
                "decimal": "",
                "emptyTable": "No hay datos disponibles en la tabla",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ horarios",
                "infoEmpty": "Mostrando 0 a 0 de 0 horarios",
                "infoFiltered": "(filtrado de _MAX_ horarios totales)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ horarios",
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
            responsive: true,
            autoWidth: false, //no le vi la funcionalidad
            dom: 'Bfrtip', // Añade el contenedor de botones
            buttons: [{
                extend: 'collection',
                text: 'Reportes',
                orientation: 'landscape',
                buttons: [{ extend: 'copy',text: '<i class="bi bi-clipboard-check btn btn-success">Copiar</i>'},
                          { extend: 'print',text: '<i class="bi bi-file-pdf-fill btn btn-danger">Imprimir</i>'},
                          { extend: 'pdf'},
                          { extend: 'csv', text: '<i class="bi bi-filetype-csv btn btn-primary">csv</i> '},
                          { extend: 'excel', text: '<i class="bi bi-file-earmark-excel btn btn-secondary">Excel</i> '},
               ]
            }, ],

        });

        // ,//NO SE ESTA VISUALIZANDO ICONO DE  BOOTSTRAP 4
    </script>
@stop
