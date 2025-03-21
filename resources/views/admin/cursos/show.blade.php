@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Sistema de reservas </h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <h1>Curso: {{ $curso->nombre }} {{ $curso->ubicacion }}</h1>

        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-info">
                    <div class="card-header">
                        <h3 class="card-title">Datos registrados</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="nombre">Nombre del curso </label><b>*</b>
                                    <p>
                                        {{ $curso->nombre }}</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="descripcion">Descripcion </label><b>*</b>
                                    <p>{{ $curso->descripcion }}</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="horas_requeridas">horas_requeridas </label><b>*</b>
                                    <p>{{ $curso->horas_requeridas }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="estado">Estado </label><b>*</b>
                                    <p>{{ $curso->estado }}</p>
                                </div>
                            </div>
                        </div>
                    </div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <a href="{{ route('admin.cursos.index') }}" class="btn btn-secondary"> Regresar
                                <i class="fa-solid fa-plus"></i>
                            </a>
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
