@extends('adminlte::page')

@section('title', 'Estadísticas de Cursos')

@section('content_header')
    <h1 class="text-primary">📊 Estadísticas de Cursos y Clientes</h1>
@stop

@section('content')
@php
    // Asegurarnos que $cursosClientes es una colección
    $cursos = collect($cursosClientes ?? []);

    // Colecciones derivadas
    $cursosCompletados = $cursos->filter(fn($c) => (int)$c->horas_realizadas >= (int)$c->horas_requeridas)->values();
    $cursosEnProgreso  = $cursos->filter(fn($c) => (int)$c->horas_realizadas < (int)$c->horas_requeridas)->values();

    // Datos para "Horas por cliente"
    $horasPorClienteLabels = $cursos->groupBy('cliente_nombre')->keys()->values();
    $horasPorClienteData = $cursos->groupBy('cliente_nombre')->map(fn($g) => $g->sum(fn($x) => (int)$x->horas_realizadas))->values();

    // Datos para "Avance por curso" (cada fila curso_cliente es una entrada)
    $avanceLabels = $cursos->map(fn($c) => $c->cliente_nombre . ' — ' . $c->curso_nombre)->values();
    $avanceData = $cursos->map(fn($c) => $c->horas_requeridas ? round(((int)$c->horas_realizadas / (int)$c->horas_requeridas) * 100, 1) : 0)->values();

    // Datos para evolución: agrupar completados por fecha (Y-m-d)
    $fechasCompletados = $cursosCompletados
        ->pluck('fecha_realizacion')
        ->filter()
        ->map(fn($f) => \Carbon\Carbon::parse($f)->format('Y-m-d'))
        ->values();

    $fechasAgrupadas = $fechasCompletados->count()
        ? $fechasCompletados->countBy()->sortKeys()
        : collect([]);

    $evolLabels = $fechasAgrupadas->keys()->values();
    $evolData = $fechasAgrupadas->values()->map(fn($v) => (int)$v)->values();
@endphp

<div class="row">
    {{-- 1️⃣ Gráfico de Completados vs En Progreso --}}
    <div class="col-md-6">
        <div class="card card-outline card-success">
            <div class="card-header">
                <h3 class="card-title">Progreso general de los cursos</h3>
            </div>
            <div class="card-body">
                <canvas id="graficoCompletados"></canvas>
            </div>
        </div>
    </div>

    {{-- 2️⃣ Horas Realizadas por Cliente --}}
    <div class="col-md-6">
        <div class="card card-outline card-info">
            <div class="card-header">
                <h3 class="card-title">Horas realizadas por cliente</h3>
            </div>
            <div class="card-body">
                <canvas id="graficoHorasPorCliente"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="row mt-3">
    {{-- 3️⃣ Avance por Curso (por cliente-curso) --}}
    <div class="col-md-6">
        <div class="card card-outline card-warning">
            <div class="card-header">
                <h3 class="card-title">Porcentaje de avance (cliente - curso)</h3>
            </div>
            <div class="card-body">
                <canvas id="graficoAvanceCursos"></canvas>
            </div>
        </div>
    </div>

    {{-- 4️⃣ Evolución de cursos completados --}}
    <div class="col-md-6">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Evolución de cursos completados</h3>
            </div>
            <div class="card-body">
                <canvas id="graficoEvolucion"></canvas>
            </div>
        </div>
    </div>
</div>

{{-- Tabla de referencia --}}
<div class="row mt-4">
    <div class="col-md-12">
        <div class="card card-outline card-secondary">
            <div class="card-header">
                <h3 class="card-title">Detalle de Cursos y Clientes</h3>
            </div>
            <div class="card-body">
                <table id="cursos" class="table table-striped table-bordered table-hover table-sm">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Cliente</th>
                            <th>Curso</th>
                            <th>Horas Realizadas / Requeridas</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = 1; @endphp
                        @foreach ($cursos as $curso)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $curso->cliente_nombre }}</td>
                                <td>{{ $curso->curso_nombre }}</td>
                                <td>{{ $curso->horas_realizadas }} / {{ $curso->horas_requeridas }}</td>
                                <td>
                                    @if ((int)$curso->horas_realizadas >= (int)$curso->horas_requeridas)
                                        <span class="badge badge-success">Completado</span>
                                    @else
                                        <span class="badge badge-warning">En progreso</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{-- Para depuración rápida (opcional) --}}
                {{-- <pre>{{ json_encode($cursos->take(10)) }}</pre> --}}
            </div>
        </div>
    </div>
</div>
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {

    // 1️⃣ Completados vs En progreso (desde la colección calculada en Blade)
    new Chart(document.getElementById('graficoCompletados'), {
        type: 'doughnut',
        data: {
            labels: ['Completados', 'En progreso'],
            datasets: [{
                data: [{{ $cursosCompletados->count() }}, {{ $cursosEnProgreso->count() }}],
                backgroundColor: ['#28a745', '#ffc107']
            }]
        },
        options: { plugins: { title: { display: true, text: 'Estado general de los cursos' } } }
    });

    // 2️⃣ Horas Realizadas por Cliente
    new Chart(document.getElementById('graficoHorasPorCliente'), {
        type: 'bar',
        data: {
            labels: {!! json_encode($horasPorClienteLabels) !!},
            datasets: [{
                label: 'Horas Realizadas',
                data: {!! json_encode($horasPorClienteData) !!},
                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                borderColor: '#007bff',
                borderWidth: 1
            }]
        },
        options: {
            plugins: { title: { display: true, text: 'Horas realizadas por cliente' } },
            scales: { y: { beginAtZero: true } }
        }
    });

    // 3️⃣ Avance por curso (cada entrada cliente-curso)
    new Chart(document.getElementById('graficoAvanceCursos'), {
        type: 'bar',
        data: {
            labels: {!! json_encode($avanceLabels) !!},
            datasets: [{
                label: 'Avance (%)',
                data: {!! json_encode($avanceData) !!},
                backgroundColor: 'rgba(255, 193, 7, 0.6)',
                borderColor: '#ffc107',
                borderWidth: 1
            }]
        },
        options: {
            indexAxis: 'y',
            plugins: { title: { display: true, text: 'Porcentaje de avance por cliente-curso' } },
            scales: { x: { beginAtZero: true, max: 100 } }
        }
    });

    // 4️⃣ Evolución de Cursos Completados
    new Chart(document.getElementById('graficoEvolucion'), {
        type: 'line',
        data: {
            labels: {!! json_encode($evolLabels) !!},
            datasets: [{
                label: 'Cursos completados',
                data: {!! json_encode($evolData) !!},
                fill: true,
                backgroundColor: 'rgba(40, 167, 69, 0.15)',
                borderColor: '#28a745',
                tension: 0.3
            }]
        },
        options: {
            plugins: { title: { display: true, text: 'Evolución de cursos completados' } },
            scales: { y: { beginAtZero: true } }
        }
    });

    // 5️⃣ Inicializar DataTable (usa jQuery DataTables si está cargado)
    if (typeof $ !== 'undefined' && $.fn.dataTable) {
        $('#cursos').DataTable({
            responsive: true,
            scrollX: true,
            dom: 'Bfrtip',
            buttons: [
                { extend: 'copyHtml5', text: 'Copiar' },
                { extend: 'excelHtml5', text: 'Excel' },
                { extend: 'pdfHtml5', text: 'PDF' },
                { extend: 'print', text: 'Imprimir' }
            ],
            language: {
                search: "Buscar:",
                lengthMenu: "Mostrar _MENU_ registros",
                info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
                paginate: { previous: "Anterior", next: "Siguiente" }
            }
        });
    } else {
        // Fallback: si usas DataTable moderno (no-jQuery) puedes inicializarlo aquí
        try {
            if (typeof DataTable !== 'undefined') {
                new DataTable('#cursos', { responsive: true, dom: 'Bfrtip' });
            }
        } catch (e) {
            console.warn('DataTable no inicializado (falta librería) -', e.message);
        }
    }

});
</script>
@stop
