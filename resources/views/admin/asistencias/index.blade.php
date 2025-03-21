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
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Cliente</th>
                                        <th>Clase</th>
                                        <th>Fecha</th>
                                        <th>Asistió</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($events as $event)
                                        <tr>
                                            <td>{{ $event->cliente->nombres }}</td>
                                            <td>{{ $event->title }}</td>
                                            <td>{{ $event->start }}</td>
                                            <td>
                                                <input type="hidden" name="eventos[{{ $event->id }}][cliente_id]" 
                                                       value="{{ $event->cliente->id }}">
                                                       <input type="checkbox" name="eventos[{{ $event->id }}][asistio]" 
                                                       value="1" 
                                                       {{ !empty($asistencias[$event->id . '-' . $event->cliente->id]) && 
                                                          $asistencias[$event->id . '-' . $event->cliente->id]->asistio ? 'checked' : '' }} 
                                                       onchange="actualizarAsistencia({{ $event->id }}, {{ $event->cliente->id }}, this.checked)">
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
        function actualizarAsistencia(eventoId, clienteId, asistio) {
            // Crear un objeto con los datos a enviar
            const data = {
                _token: '{{ csrf_token() }}',
                eventos: {
                    [eventoId]: {
                        cliente_id: clienteId,
                        asistio: asistio ? 1 : 0
                    }
                }
            };

            // Realizar la solicitud POST usando Fetch API
            fetch("{{ route('admin.asistencias.store') }}", {
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
