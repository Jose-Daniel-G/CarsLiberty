    @extends('adminlte::page')

    @section('title', 'Dashboard')

    @section('content_header')
        <h1>Sistema de reservas </h1>
    @stop

    @section('content')

        <div class="row">
            <h1>Cliente: {{ $cliente->nombres }} {{ $cliente->apellidos }}</h1>

        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Datos</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="nombres">Nombres </label>
                                    <p>{{ $cliente->nombres }}</p>

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="apellidos">Apellidos </label>
                                    <p>{{ $cliente->apellidos }}</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="cc">Cc </label>
                                    <p>{{ $cliente->cc }}</p>

                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="celular">Celular </label>
                                    <p>{{ $cliente->celular }}</p>

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="genero">Sexo </label>
                                    @if ($cliente->genero == 'M')
                                        'Masculino'
                                    @else
                                        'Femenino'
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="correo">Correo </label>
                                    <p>{{ $cliente->correo }}</p>

                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="direccion">Direccion </label>
                                    <p>{{ $cliente->direccion }}</p>

                                </div>
                            </div>
                            {{-- <div class="col-md-3">
                                <div class="form-group">
                                    <label for="grupo_sanguineo">Grupo sanguineo</label>
                                    <p>{{ $cliente->agrupo_sanguineo }}</p>
                                </div>
                            </div> --}}
                            {{-- <div class="col-md-3">
                                <div class="form-group">
                                    <label for="alergias">Alergias</label>
                                    <p>{{ $cliente->alergias }}</p>
                                </div>
                            </div> --}}
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="contacto_emergencia">Contacto Emergencia</label>
                                    <p>{{ $cliente->contacto_emergencia }}</p>
                                </div>

                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="observaciones">Observaciones</label>
                                    <p>{{ $cliente->observaciones }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <a href="{{ route('admin.clientes.index') }}" class="btn btn-secondary">
                            Regresar
                            {{-- <i class="fa-solid fa-plus"></i> --}}
                        </a>
                    </div>
                </div>
            </div>
        </div>

    @stop

    @section('css')

    @stop

    @section('js')

    @stop
