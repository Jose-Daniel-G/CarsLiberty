@extends('adminlte::page')

@section('title', 'Cursos del Cliente')

@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
@stop

@section('content_header')
    <h1 class="mb-3 text-center">📘 Estado de Cursos</h1>
@stop

@section('content')

<div class="container-fluid">
    {{-- ✅ CURSOS COMPLETADOS --}}
    <div class="card card-outline card-success mb-4">
        <div class="card-header bg-success text-white">
            <h4 class="mb-0"><i class="fas fa-check-circle"></i> Cursos Completados</h4>
        </div>
        <div class="card-body">
            @if($cursosCompletados->isEmpty())
                <p class="text-muted">No hay cursos completados aún.</p>
            @else
                <div class="row">
                    @foreach ($cursosCompletados as $curso)
                        <div class="col-md-4 mb-4">
                            <div class="card border-success shadow-sm">
                                <div class="card-body">
                                    <h5 class="card-title text-success fw-bold">{{ $curso->nombre ?? $curso->curso_nombre }}</h5>
                                    <p><strong>Horas Requeridas:</strong> {{ $curso->horas_requeridas }}</p>
                                    <p><strong>Horas Realizadas:</strong> {{ $curso->horas_realizadas }}</p>

                                    {{-- Barra de progreso --}}
                                    @php
                                        $porcentaje = ($curso->horas_realizadas / $curso->horas_requeridas) * 100;
                                    @endphp
                                    <div class="progress mb-2">
                                        <div class="progress-bar bg-success" style="width: {{ $porcentaje }}%;">
                                            {{ number_format($porcentaje, 0) }}%
                                        </div>
                                    </div>

                                    {{-- Botón modal --}}
                                    <button class="btn btn-outline-success btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#cursoModal{{ $curso->id }}">
                                        Ver Detalles
                                    </button>
                                </div>
                            </div>
                        </div>

                        {{-- Modal con gráfico --}}
                        <div class="modal fade" id="cursoModal{{ $curso->id }}" tabindex="-1"
                            aria-labelledby="cursoModalLabel{{ $curso->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header bg-success text-white">
                                        <h5 class="modal-title" id="cursoModalLabel{{ $curso->id }}">
                                            {{ $curso->nombre ?? $curso->curso_nombre }}
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Cerrar"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p><strong>Horas Totales:</strong> {{ $curso->horas_requeridas }}</p>
                                        <p><strong>Horas Realizadas:</strong> {{ $curso->horas_realizadas }}</p>
                                        <canvas id="graficaCurso{{ $curso->id }}"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    {{-- 🕓 CURSOS EN PROGRESO --}}
    <div class="card card-outline card-warning">
        <div class="card-header bg-warning text-dark">
            <h4 class="mb-0"><i class="fas fa-hourglass-half"></i> Cursos en Progreso</h4>
        </div>
        <div class="card-body">
            @if($cursosEnProgreso->isEmpty())
                <p class="text-muted">No hay cursos en progreso actualmente.</p>
            @else
                <div class="row">
                    @foreach ($cursosEnProgreso as $curso)
                        <div class="col-md-4 mb-4">
                            <div class="card border-warning shadow-sm">
                                <div class="card-body">
                                    <h5 class="card-title text-warning fw-bold">{{ $curso->nombre ?? $curso->curso_nombre }}</h5>
                                    <p><strong>Horas Requeridas:</strong> {{ $curso->horas_requeridas }}</p>
                                    <p><strong>Horas Realizadas:</strong> {{ $curso->horas_realizadas }}</p>

                                    {{-- Barra de progreso --}}
                                    @php
                                        $porcentaje = ($curso->horas_realizadas / $curso->horas_requeridas) * 100;
                                    @endphp
                                    <div class="progress mb-2">
                                        <div class="progress-bar bg-warning text-dark" style="width: {{ $porcentaje }}%;">
                                            {{ number_format($porcentaje, 0) }}%
                                        </div>
                                    </div>

                                    {{-- Botón modal --}}
                                    <button class="btn btn-outline-warning btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#cursoModal{{ $curso->id }}">
                                        Ver Detalles
                                    </button>
                                </div>
                            </div>
                        </div>

                        {{-- Modal con gráfico --}}
                        <div class="modal fade" id="cursoModal{{ $curso->id }}" tabindex="-1"
                            aria-labelledby="cursoModalLabel{{ $curso->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header bg-warning text-dark">
                                        <h5 class="modal-title" id="cursoModalLabel{{ $curso->id }}">
                                            {{ $curso->nombre ?? $curso->curso_nombre }}
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Cerrar"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p><strong>Horas Totales:</strong> {{ $curso->horas_requeridas }}</p>
                                        <p><strong>Horas Realizadas:</strong> {{ $curso->horas_realizadas }}</p>
                                        <canvas id="graficaCurso{{ $curso->id }}"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Renderiza gráficos para todos los cursos completados
        @foreach ($cursosCompletados as $curso)
            new Chart(document.getElementById("graficaCurso{{ $curso->id }}"), {
                type: 'bar',
                data: {
                    labels: ['Horas Realizadas', 'Horas Requeridas'],
                    datasets: [{
                        label: 'Progreso del Curso',
                        data: [{{ $curso->horas_realizadas }}, {{ $curso->horas_requeridas }}],
                        backgroundColor: ['rgba(75, 192, 192, 0.6)', 'rgba(153, 102, 255, 0.6)'],
                        borderColor: ['rgba(75, 192, 192, 1)', 'rgba(153, 102, 255, 1)'],
                        borderWidth: 1
                    }]
                },
                options: { scales: { y: { beginAtZero: true } } }
            });
        @endforeach

        // Renderiza gráficos para los cursos en progreso
        @foreach ($cursosEnProgreso as $curso)
            new Chart(document.getElementById("graficaCurso{{ $curso->id }}"), {
                type: 'bar',
                data: {
                    labels: ['Horas Realizadas', 'Horas Requeridas'],
                    datasets: [{
                        label: 'Progreso del Curso',
                        data: [{{ $curso->horas_realizadas }}, {{ $curso->horas_requeridas }}],
                        backgroundColor: ['rgba(255, 206, 86, 0.6)', 'rgba(201, 203, 207, 0.6)'],
                        borderColor: ['rgba(255, 206, 86, 1)', 'rgba(201, 203, 207, 1)'],
                        borderWidth: 1
                    }]
                },
                options: { scales: { y: { beginAtZero: true } } }
            });
        @endforeach
    });
</script>
@stop
