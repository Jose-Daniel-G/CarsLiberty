@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Sistema de reservas </h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <h1>Curso: {{ $profesor->nombre }} {{ $profesor->ubicacion }}</h1>

        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-info">
                    <div class="card-header">
                        <h3 class="card-title">Datos registrados</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.profesores.update', $profesor->id) }}" method="POST"
                            autocomplete="off">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="nombre">Nombre del profesor </label><b class="text-danger">*</b>
                                        <p>
                                            {{ $profesor->nombre }}
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="ubicacion">Ubicacion </label><b class="text-danger">*</b>
                                        <p>
                                            {{ $profesor->ubicacion }}
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="capacidad">Capacidad </label><b class="text-danger">*</b>
                                        <p>
                                            {{ $profesor->capacidad }}
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="telefono">Telefono </label><b class="text-danger">*</b>
                                        <p>
                                            {{ $profesor->telefono }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                {{-- <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="especialidad">Especialidad </label><b class="text-danger">*</b>
                                        <p>
                                            {{ $profesor->especialidad }}
                                        </p>
                                    </div>
                                </div> --}}

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="estado">Estado </label><b class="text-danger">*</b>
                                            <!-- Opción por defecto -->
                                            <p>{{ $profesor->estado == 'A' ? 'Activo' : 'Inactivo' }}</p>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <a href="{{ route('admin.profesores.index') }}" class="btn btn-secondary">
                                            Regresar
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </form>

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
