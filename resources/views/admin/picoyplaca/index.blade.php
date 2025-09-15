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

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('picoyplaca.update') }}" method="POST">
            @csrf
            @method('PUT')
            <table id="pico-placa" class="table table-striped table-bordered table-hover table-sm">
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
                                    <input type="time" class="form-control" name="horario_inicio[{{ $horario->id }}]"
                                        value="{{ $horario->horario_inicio }}" required>
                                </td>
                                <td>
                                    <input type="time" class="form-control" name="horario_fin[{{ $horario->id }}]"
                                        value="{{ $horario->horario_fin }}" required>
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="placas_reservadas[{{ $horario->id }}]"
                                        value="{{ $horario->placas_reservadas }}" required>
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Actualizar</button>
            </div>
        </form>

    </div>
@stop
@section('js')
    <script> 
            new DataTable('#pico-placa', {
                responsive: true,
                autoWidth: false,
                scrollX: true,
            });
    </script>
@stop
