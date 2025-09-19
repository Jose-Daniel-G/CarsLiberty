@extends('adminlte::page')

@section('title', 'Asistencia')

@section('content_header')
    <h2>Asistencia a Clase de Conducción</h2>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Lista</h3>
                </div>
                <div class="card-body">
                    <form id="asistenciaForm" action="{{ route('admin.asistencias.store') }}" method="POST">
                        @csrf
                        <div class="table-responsive">
                            <table id="asistencias" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Cliente</th>
                                        <th>Clase</th>
                                        <th>Fecha</th>
                                        <th>Asistió</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($agendas as $agenda)
                                        <tr>
                                            <td>{{ $agenda->cliente->nombres }}</td>
                                            <td>{{ $agenda->title }}</td>
                                            <td>{{ $agenda->start }}</td>
                                            <td>
                                        <input type="hidden" name="agendaos[{{ $agenda->id }}][cliente_id]" 
                                                value="{{ $agenda->cliente->id }}">
                                                <input type="checkbox" name="agendaos[{{ $agenda->id }}][asistio]" 
                                                value="1" 
                                                {{ !empty($asistencias[$agenda->id . '-' . $agenda->cliente->id]) && 
                                                    $asistencias[$agenda->id . '-' . $agenda->cliente->id]->asistio ? 'checked' : '' }} 
                                                onchange="actualizarAsistencia({{ $agenda->id }}, {{ $agenda->cliente->id }}, this.checked)">
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script> 
            new DataTable('#asistencias', {
                responsive: true,
                autoWidth: false,scrollX:true,
                scrollX: true,
            });
    </script>
    <script>
        function actualizarAsistencia(agendaoId, clienteId, asistio) {

            const data = {                                              // Crear un objeto con los datos a enviar
                _token: '{{ csrf_token() }}',
                agendaos: {[agendaoId]: { cliente_id: clienteId, asistio: asistio ? 1 : 0}}
            };

            fetch("{{ route('admin.asistencias.store') }}", {            // Realizar la solicitud POST usando Fetch API
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            })
            .then(response => {
                if (!response.ok) throw new Error('Error en la actualización');
                return response.json();
            })
            .then(data => {
                console.log('Asistencia actualizada correctamente');
            })
            .catch(error => {
                console.error('Hubo un problema con la actualización:', error);
            });
        }
    </script>
@endsection
