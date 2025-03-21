@extends('adminlte::page')

@section('title', 'Dashboard')

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
@stop

@section('content_header')
    <h1>Sistema de Reservas</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <h1>Informacion general</h1>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Llene los Datos</h3>
                    </div>
                    <div class="card-body">
                        @foreach ($cursosCompletados as $curso)
                            <div class="col-md-4 mb-4">
                                <div class="card shadow-sm border-success h-100">
                                    <div class="card-body text-center">
                                        <h5 class="card-title"></h5>
                                        <p class="card-text">{{ Str::limit($curso->descripcion, 100) }}</p>
                                        <p class="mb-2"><strong>Horas Realizadas:</strong> {{ $curso->horas_realizadas }}
                                            / {{ $curso->horas_requeridas }}</p>
                                        <button type="button" class="btn btn-success" data-toggle="modal"
                                            data-target="#cursoModal{{ $curso->id }}">
                                            Más Info
                                        </button>
                                    </div>
                                </div>
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
