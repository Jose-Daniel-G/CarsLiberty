@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Sistema de reservas </h1>
@stop

@section('content')
    <div class="container-fluid">

        <div class="row">
            <h1>Informacion</h1>

        </div>
        <div class="row">
            <div class="col-md-10">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Datos</h3>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name">Nombre del usuario </label>
                                    <p>{{ $usuario->name }}</p>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <p>{{ $usuario->email }}</p>
                                </div>
                                <p>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                                        Regresar
                                    </a>

                                </div>
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
