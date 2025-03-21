@extends('adminlte::page')

@section('title', 'Dashboard')

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
@stop

@section('content_header')
    <h1>Sistema de Reservas</h1>
@stop

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Informacion de cursos terminados por cliente</h3>
                </div>
                <div class="card-body">
                    @foreach ($cursosCompletados as $curso)
                        <div class="col-md-4 mb-4">
                            <table id="cursos" class="table table-striped table-bordered table-hover table-sm">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Nro</th>
                                        <th>Nombres Apellidos</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $contador = 1; ?>
                                    {{-- @foreach ($cursos as $curso)
                                                    <tr>
                                                        <td scope="row">{{ $contador++ }}</td>
                                                        <td scope="row">{{ $curso->nombre }}</td>
                                                        <td scope="row">{{ $curso->horas_requeridas }}</td>
                                                        <td scope="row">{{ $curso->estado == 'A' ? 'Activo' : 'Inactivo' }}</td>
                                                        <td scope="row">
                                                            <div class="btn-group" role="group" aria-label="basic example">
                                                                <a href="{{ route('admin.cursos.show', $curso->id) }}"
                                                                    class="btn btn-info btn-sm"><i class="fas fa-eye"></i>
                                                                </a>
                                                                <a href="{{ route('admin.cursos.edit', $curso->id) }}"
                                                                    class="btn btn-success btn-sm"><i class="fas fa-edit"></i>
                                                                </a>
                                                                <form id="delete-form-{{ $curso->id }}" action="{{ route('admin.cursos.destroy', $curso->id) }}" method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $curso->id }})"><i
                                                                            class="fas fa-trash"></i></button>
                                                                </form>
                    
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach --}}
                                </tbody>
                            </table>

                        </div>

                        <!-- Modal para cada curso -->
                        <div class="modal fade" id="cursoModal{{ $curso->id }}" tabindex="-1"
                            aria-labelledby="cursoModalLabel{{ $curso->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="cursoModalLabel{{ $curso->id }}">
                                            {{ $curso->nombre }}</h5>
                                        <button type="button" class="btn-close" data-dismiss="modal"
                                            aria-label="Cerrar"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p><strong>Descripción:</strong> {{ $curso->descripcion }}</p>
                                        <p><strong>Horas Totales:</strong> {{ $curso->horas_requeridas }}</p>
                                        <p><strong>Horas Realizadas:</strong> {{ $curso->horas_realizadas }}</p>

                                        <!-- Contenedor de Gráfica -->
                                        <div>
                                            <canvas id="graficaCurso{{ $curso->id }}"></canvas>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Cerrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            @foreach ($cursosCompletados as $curso)
                var ctx = document.getElementById("graficaCurso{{ $curso->id }}").getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'bar', // Tipo de gráfica (puedes cambiar a 'line', 'pie', etc.)
                    data: {
                        labels: ["Horas Realizadas", "Horas Totales"],
                        datasets: [{
                            label: 'Progreso del Curso',
                            data: [{{ $curso->horas_realizadas }},
                                {{ $curso->horas_requeridas }}
                            ], // Datos reales de cada curso
                            backgroundColor: [
                                'rgba(75, 192, 192, 0.5)',
                                'rgba(153, 102, 255, 0.5)'
                            ],
                            borderColor: [
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            @endforeach
        });
    </script>
@endsection
