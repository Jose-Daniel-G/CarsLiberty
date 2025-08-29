    @extends('adminlte::page')

    @section('title', 'Dashboard')

    @section('content_header')
        <h1>Sistema de reservas </h1>
    @stop

    @section('content')

        <div class="row">
            <h1>Programador: {{ $secretaria->nombres }} {{ $secretaria->apellidos }}</h1>

        </div>
        <div class="row">
            <div class="col-md-10">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Datos</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="nombres">Nombres </label>
                                    <p>{{ $secretaria->nombres }}</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="apellidos">Apellidos </label>
                                    <p>{{ $secretaria->apellidos }}</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="cc">CC </label>
                                    <p>{{ $secretaria->cc }}</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="celular">Celular </label>
                                    <p>{{ $secretaria->celular }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="fecha_nacimiento">Fecha de Nacimiento </label>
                                    <p>{{ $secretaria->fecha_nacimiento }}</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="direccion">Direccion </label>
                                    <p>{{ $secretaria->direccion }}</p>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <p>{{ $secretaria->user->email }}</p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <a href="{{ route('admin.secretarias.index') }}" class="btn btn-secondary">Regresar
                            <i class="fas fa-fw fa-share fa-flip-horizontal fa-flip-vertical"></i>

                        </a>
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
