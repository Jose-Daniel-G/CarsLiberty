@extends('adminlte::page')

@section('title', 'CarsLiberty'){{-- @section('plugins.Sweetalert2', true) --}}
@section('css')
    @vite('resources/css/items.css')
@stop

@section('content_header'){{-- <h1><b>Bienvenido:</b> {{ Auth::user()->email }} / <b>Rol:</b> {{ Auth::user()->roles->pluck('name')->first() }}</h1> --}}
@stop
@section('content')
    <div class="row pt-3">
        {{-- Configuracion --}}
        @can('admin.config.index')
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $t_configuraciones }}</h3>
                        <p>Configuracion</p>
                    </div>
                    <div class="icon">
                        <i class="fa-solid fa-gear"></i>
                    </div>
                    <a href="{{ route('admin.config.index') }}" class="small-box-footer">Mas info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        @endcan
        {{-- Programador --}}
        @can('admin.secretarias.index')
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $t_secretarias }}</h3>
                        <p>Programador</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-laptop"></i>
                    </div>
                    <a href="{{ route('admin.secretarias.index') }}" class="small-box-footer">Mas info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        @endcan
        {{-- Clientes --}}
        @can('admin.clientes.index')
            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ $t_clientes }}</h3>
                        <p>Clientes</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-users mr-2"></i>
                    </div>
                    <a href="{{ route('admin.clientes.index') }}" class="small-box-footer">Mas info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        @endcan
        {{-- Cursos --}}
        @can('admin.cursos.index')
            <div class="col-lg-3 col-6">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ $t_cursos }}</h3>
                        <p>Cursos</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-book"></i>
                    </div>
                    <a href="{{ route('admin.cursos.index') }}" class="small-box-footer">Mas info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        @endcan
        {{-- Profesores --}}
        @can('admin.clientes.index')
            <div class="col-lg-3 col-6">
                <div class="small-box bg-primary">
                    <div class="inner">
                        <h3>{{ $t_profesores }}</h3>
                        <p>Profesores</p>
                    </div>
                    <div class="icon"><i class="fa-solid fa-chalkboard-user"></i>
                    </div>
                    <a href="{{ route('admin.profesores.index') }}" class="small-box-footer">Mas info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        @endcan
        {{-- Horarios --}}
        @can('admin.horarios.index')
            <div class="col-lg-3 col-6">
                <div class="small-box bg-secondary">
                    <div class="inner">
                        <h3>{{ $t_horarios }}</h3>

                        <p>{{ __('actions.schedules') }}</p>
                    </div>
                    <div class="icon">
                        <i class="fa-solid fa-calendar-days"></i>
                    </div>
                    <a href="{{ route('admin.horarios.index') }}" class="small-box-footer">Mas info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        @endcan
        {{-- Reservas --}}
        @can('admin.reservas.index')
            <div class="col-lg-3 col-6">
                <div class="small-box bg-secondary">
                    <div class="inner">
                        <h3>{{ $t_agendas }}</h3>

                        <p>Reservas</p>
                    </div>
                    <div class="icon">
                        <i class="ion fas bi bi-calendar2-week"></i>
                    </div>
                    <a href="" class="small-box-footer"> <i class="fas fa-calendar-alt"></i></a>
                </div>
            </div>
        @endcan
        {{-- Vehiculos --}}
        @can('admin.vehiculos.index')
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $t_vehiculos }}</h3>

                        <p>Vehiculos</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-car"></i>
                    </div>
                    <a href="{{ route('admin.vehiculos.index') }}" class="small-box-footer">Mas info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        @endcan
        {{-- Completados --}}
        @can('admin.cursos.completados')
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        @if (Auth::user()->hasRole('superAdmin') || Auth::user()->hasRole('admin') || Auth::user()->hasRole('secretaria'))
                            <h4>Estadísticas</h4>
                            <h5 class="mb-2">(Cursos)</h5>
                            <br>
                        @else
                            <div>
                                <h3>{{ $t_cursos }}</h3>
                                <p>Cursos </p>
                            </div>
                        @endif

                    </div>
                    <div class="icon"> <i class="fa-regular fa-check-circle"></i>
                    </div>
                    <a href="{{ route('admin.cursos.completados') }}" class="small-box-footer">Mas info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        @endcan
    </div>
    <div class="card card-primary card-outline card-tabs">
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-md-6">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#claseModal">
                                Agendar
                            </button>
                            <a href="{{ route('admin.home.show') }}" class="btn btn-success">
                                <i class="bi bi-calendar-check"></i>Ver las reservas
                            </a>
                        </div>
                        <div class="col-md-2 d-flex justify-content-end">
                            <label for="curso_id">Cursos </label><b class="text-danger">*</b>
                        </div>
                        <div class="col-md-4">
                            <select name="curso_id" id="profesor_id" class="form-control">
                                <option value="" selected disabled>Seleccione</option>
                                @foreach ($profesorSelect as $curso)
                                    <option value="{{ $curso->id }}">
                                        {{ $curso->cursos . ' - ' . $curso->nombres }} </option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                </div>

            </div>
            <div class="row">

                <div class="col-12">
                    <div id="profesor_info"></div>
                    <div id="calendar" style="min-height: 500px;"></div>
                </div>
            </div>
        </div>
    </div>

    </div>

    @include('admin.agenda-modal.agenda')
    </div>
    {{-- PROFESORES AGENDA --}}
    @if (Auth::check() && Auth::user()->profesor)
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-4">
                                <h3 class="card-title">Calendario de reservas</h3>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        {{ Auth::user()->profesor->nombres }}
                        <table id="reservas" class="table table-striped table-bordered table-hover table-sm">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Nro</th>
                                    <th>Profesor</th>
                                    <th>Cliente</th>
                                    <th>Fecha de la reserva</th>
                                    <th>Hora de reserva</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $contador = 1; ?>
                                @foreach ($agendas as $agenda)
                                    @if (Auth::user()->profesor->id == $agenda->profesor_id)
                                        <tr>
                                            <td scope="row">{{ $contador++ }}</td>
                                            <td scope="row">
                                                {{ $agenda->profesor->nombres . ' ' . $agenda->profesor->apellidos }}
                                            </td>
                                            <td scope="row">
                                                {{ $agenda->cliente->nombres . ' ' . $agenda->cliente->apellidos }}
                                            </td>
                                            <td scope="row" class="text-center">
                                                {{ $agenda->start->format('d M, Y') }}</td>
                                            <td scope="row" class="text-center">
                                                {{ $agenda->end->format('H:i') }}</td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endif

@stop

@section('js')

    <script>
        window.Laravel = {
            isAdmin: @json(Auth::check() && Auth::user()->hasRole('superAdmin')),
            routes: {
                horariosShowReservaProfesores: "{{ route('admin.horarios.show_reserva_profesores') }}",
            }
        };
    </script>

    @vite(['resources/js/pages/dashboard.ts'])
    <script>
        // ---------------------------------------
        // Cargar contenido dinámico en selects
        // --------------------------------------- 
        $('#cursoid').on('change', function() {
            const cursoid = $(this).val();
            if (!cursoid) return;
            const url = "{{ route('admin.obtenerProfesores', ':id') }}".replace(':id', cursoid);
            $.get(url, function(data) {
                if (Array.isArray(data)) {
                    $('#profesorid').empty().append(
                        '<option value="" selected disabled>Seleccione un Profesor</option>');
                    data.forEach(p => $('#profesorid').append(
                        `<option value="${p.id}">${p.nombres} ${p.apellidos}</option>`));
                } else {
                    alert('No se encontraron profesores');
                }
            }).fail(() => alert('Error al cargar los profesores'));
        });

        $('#cliente_id').on('change', function() {
            const cliente_id = $(this).val();
            if (!cliente_id) return;
            const url = "{{ route('admin.obtenerCursos', ':id') }}".replace(':id', cliente_id);
            $.get(url, function(data) {
                if (Array.isArray(data)) {
                    $('#cursoid').empty().append(
                        '<option value="" selected disabled>Seleccione un Curso</option>');
                    data.forEach(c => $('#cursoid').append(`<option value="${c.id}">${c.nombre}</option>`));
                } else {
                    alert('No se encontraron cursos');
                }
            }).fail(() => alert('Error al cargar los cursos'));
        });
    </script>

@stop
