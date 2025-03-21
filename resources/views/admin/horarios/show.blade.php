@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Sistema de reservas </h1>
@stop

@section('content')
    <div class="container-fluid">
        {{-- <div class="row">
            <h1>Curso: {{ $horario->curso->nombre }} {{ $horario->curso->ubicacion }}</h1>
        </div> --}}
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-info">
                    <div class="card-header">
                        <h3 class="card-title">Datos registrados</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="profesor_id">Profesores </label>
                                    <p>{{ $horario->profesor->nombres . ' ' . $horario->profesor->apellidos }}</p>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="curso_id">Cursos </label>
                                    <p>
                                        {{ $horario->curso->nombres  .'  '. $horario->curso->ubicacion }}
                                    </p>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="dia">Dia </label>
                                    <p>{{ $horario->dia }}</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="hora_inicio">Hora Inicio </label>
                                    <p>{{ $horario->hora_inicio }}</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="hora_fin">Hora Final </label>
                                    <p>{{ $horario->hora_fin }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <a href="{{ route('admin.horarios.index') }}" class="btn btn-secondary">Regresar</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@stop

@section('css')

@stop

@section('js')

@stop
