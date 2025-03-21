@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Sistema de reservas </h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <h1>Cosultorio: {{ $config->nombre }}</h1>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Llene los Datos</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="nombre">Nombre de la CLinica/Hospital </label><b>*</b>
                                    <p>{{ $config->nombre }}</p>

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="direccion">Direccion </label><b>*</b>
                                    <p>{{ $config->direccion }}</p>

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="telefono">Telefono </label><b>*</b>
                                    <p>{{ $config->telefono }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="correo">Correo </label><b>*</b>
                                    <p>{{ $config->correo }}</p>

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="logo">Logo </label><b>*</b>
                                    <p>{{ $config->logo }}</p>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <a href="{{ route('admin.config.index') }}" class="btn btn-secondary">
                        Regresar
                        {{-- <i class="fa-solid fa-plus"></i> --}}
                    </a>
                </div>
            </div>
        </div>

    @stop

    @section('css')

    @stop

    @section('js')

    @stop
