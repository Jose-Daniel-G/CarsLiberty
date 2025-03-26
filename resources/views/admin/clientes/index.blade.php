@extends('adminlte::page')

@section('title', 'Dashboard')
@section('css')
@stop
@section('content_header')
    <h1>Sistema de reservas </h1>
@stop

@section('content')
    <div class="row">
        <h1>Panel principal</h1>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Usuarios registrados</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.clientes.create') }}" class="btn btn-primary">Registrar
                            {{-- <i class="fa-solid fa-plus"></i> --}}
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    @if ($info = Session::get('info'))
                        <div class="alert alert-success"><strong>{{ $info }}</strong></div>
                    @endif
                    <table id="clientes" class="table table-striped table-bordered table-hover table-sm">
                        <thead class="thead-dark">
                            <tr>
                                <th>Nro</th>
                                <th>Nombres</th>
                                <th>Apellidos</th>
                                <th>cc</th>
                                <th>Celular</th>
                                <th>Direccion</th>
                                <th>Acciones</th>
                                <th>Activo</th>
                                {{-- <th>Email</th> --}}
                                {{-- <th>Fecha de Nacimiento</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            <?php $contador = 1; ?>
                            @foreach ($clientes as $cliente)
                                <tr>
                                    <td scope="row">{{ $contador++ }}</td>
                                    <td scope="row">{{ $cliente->nombres }}</td>
                                    <td scope="row">{{ $cliente->apellidos }}</td>
                                    <td scope="row">{{ $cliente->cc }}</td>
                                    <td scope="row">{{ $cliente->celular }}</td>
                                    <td scope="row">{{ $cliente->direccion }}</td>
                                    {{-- <td scope="row">{{ $cliente->user->email }}</td> --}}
                                    <td scope="row ">
                                        <div class="text-center">
                                            <div class="btn-group" role="group" aria-label="basic example">
                                                <a href="{{ route('admin.clientes.show', $cliente->id) }}"
                                                    class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                                <a href="{{ route('admin.clientes.edit', $cliente->id) }}"
                                                    class="btn btn-success btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                    <td scope="row">
                                        <div class="text-center">
                                            <form id="delete-form-{{ $cliente->id }}"
                                                action="{{ route('admin.clientes.toggleStatus', $cliente->user->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('PATCH') <!-- Laravel permite cambios parciales con PATCH -->
                                                <button type="submit"
                                                    class="btn {{ $cliente->user->status ? 'btn-success' : 'btn-danger' }}">
                                                    {!! $cliente->user->status
                                                        ? '<i class="fa-solid fa-square-check"></i>'
                                                        : '<i class="fa-solid fa-circle-xmark"></i>' !!}
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            {{-- <form id="delete-form-{{ $cliente->id }}"
                                                action="{{ route('admin.clientes.destroy', $cliente->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-danger"
                                                    onclick="confirmDelete({{ $cliente->id }})"><i
                                                        class="fas fa-trash"></i></button>
                                            </form> --}}
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
        new DataTable('#clientes', {
            responsive: true,
            autoWidth: false, //no le vi la funcionalidad
            dom: 'Bfrtip', // Añade el contenedor de botones
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print', 'colvis' // Botones que aparecen en la imagen
            ],
            "language": {
                "decimal": "",
                "emptyTable": "No hay datos disponibles en la tabla",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ clientes",
                "infoEmpty": "Mostrando 0 a 0 de 0 clientes",
                "infoFiltered": "(filtrado de _MAX_ clientes totales)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ clientes",
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

        // function confirmDelete(id) {
        //     Swal.fire({
        //         title: '¿Estás seguro?',
        //         text: "¿Estás seguro de que deseas eliminar este cliente?",
        //         icon: 'warning',
        //         showCancelButton: true,
        //         confirmButtonColor: '#3085d6',
        //         cancelButtonColor: '#d33',
        //         confirmButtonText: 'Sí, eliminar',
        //         cancelButtonText: 'Cancelar'
        //     }).then((result) => {
        //         if (result.isConfirmed) {
        //             // Si el usuario confirma, se envía el formulario.
        //             document.getElementById('delete-form-' + id).submit();
        //         }
        //     });
        // }
    </script>
@stop
