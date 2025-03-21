@extends('adminlte::page')

@section('title', 'Dashboard')

@section('css')
@stop

@section('content_header')
    <h1>Sistema de reservas</h1>
@stop

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Horarios de Pico y Placa</h1>
    <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#editAllModal">Editar general de la semana</button>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-striped table-bordered table-hover table-sm">
        <thead>
            <tr>
                <th>Día</th>
                <th>Desde</th>
                <th>Hasta</th>
                <th>Placas</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($picoyplaca as $dia => $items)
                <tr>
                    <td>{{ $dia }}</td>
                    <td>
                        @foreach ($items as $item)
                            <div>{{ $item->horario_inicio }}</div>
                        @endforeach
                    </td>
                    <td>
                        @foreach ($items as $item)
                            <div>{{ $item->horario_fin }}</div>
                        @endforeach
                    </td>
                    <td>
                        @foreach ($items as $item)
                            <div>{{ $item->placas_reservadas }}</div>
                        @endforeach
                    </td>
                    <td>
                        <button class="btn btn-warning" data-toggle="modal" data-target="#editPicoyPlacaModal{{ $items[0]->id }}">Editar</button>
                    </td>
                </tr>

                <!-- Modal Editar -->
                <div class="modal fade" id="editPicoyPlacaModal{{ $items[0]->id }}" tabindex="-1" role="dialog" aria-labelledby="editPicoyPlacaModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Editar Horario de {{ $dia }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('admin.picoyplaca.update', $items[0]->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="horario_inicio">Desde</label>
                                        <input type="time" class="form-control" name="horario_inicio" value="{{ $items[0]->horario_inicio }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="horario_fin">Hasta</label>
                                        <input type="time" class="form-control" name="horario_fin" value="{{ $items[0]->horario_fin }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="placas_reservadas">Placas Reservadas</label>
                                        <input type="text" class="form-control" name="placas_reservadas" value="{{ $items[0]->placas_reservadas }}" required>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                        <button type="submit" class="btn btn-primary">Actualizar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </tbody>
    </table>

    <!-- Modal para Editar Todos los Horarios -->
    <div class="modal fade" id="editAllModal" tabindex="-1" role="dialog" aria-labelledby="editAllModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar Todos los Horarios de Pico y Placa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('picoyplaca.updateAll') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Día</th>
                                    <th>Desde</th>
                                    <th>Hasta</th>
                                    <th>Placas Reservadas</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($picoyplaca as $dia => $horarios)
                                    @foreach ($horarios as $horario)
                                        <tr>
                                            <td>{{ $horario->dia }}</td>
                                            <td>
                                                <input type="time" class="form-control" name="horario_inicio[{{ $horario->id }}]" value="{{ $horario->horario_inicio }}" required>
                                            </td>
                                            <td>
                                                <input type="time" class="form-control" name="horario_fin[{{ $horario->id }}]" value="{{ $horario->horario_fin }}" required>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="placas_reservadas[{{ $horario->id }}]" value="{{ $horario->placas_reservadas }}" required>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Actualizar Todos</button>
                </div>
                </form>
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
                text: "Esta acción eliminará el registro.",
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
    </script>

    @if (session('info') && session('icono'))
        <script>
            Swal.fire({
                title: "{{ session('title') }}",
                text: "{{ session('info') }}",
                icon: "{{ session('icono') }}"
            });
        </script>
    @endif
@stop
