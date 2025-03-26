    @extends('adminlte::page')

    @section('title', 'Dashboard')

    @section('content_header')
        <h1>Sistema de reservas </h1>
    @stop

    @section('content')

        <div class="row">
            <h1>Actualizacion profesor: {{ $profesor->nombre }} {{ $profesor->ubicacion }}</h1>

        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Datos</h3>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('admin.profesores.update', $profesor->id) }}" method="POST" autocomplete="off">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="nombres">Nombre del profesor </label><b class="text-danger">*</b>
                                        <input type="text" class="form-control" name="nombres"
                                            value="{{ $profesor->nombres }}" required>
                                        @error('nombres')
                                            <small class="bg-danger text-white p-1">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="apellidos">Apellidos </label><b class="text-danger">*</b>
                                        <input type="text" class="form-control" name="apellidos"
                                            value="{{ $profesor->apellidos }}" required>
                                        @error('apellidos')
                                            <small class="bg-danger text-white p-1">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="telefono">Telefono </label><b class="text-danger">*</b>
                                        <input type="number" class="form-control" name="telefono"
                                            value="{{ $profesor->telefono }}" required>
                                        @error('telefono')
                                            <small class="bg-danger text-white p-1">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                {{-- <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="especialidad">Especialidad </label><b class="text-danger">*</b>
                                        <input type="text" class="form-control" name="especialidad"
                                            value="{{ $profesor->especialidad }}" required>
                                        @error('especialidad')
                                            <small class="bg-danger text-white p-1">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div> --}}

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="email">Email </label><b class="text-danger">*</b>
                                        <input type="email" class="form-control" name="email"
                                            value="{{ $profesor->user->email }}" required>
                                        @error('email')
                                            <small class="bg-danger text-white p-1">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="password">Contrasena </label><b class="text-danger">*</b>
                                        <input type="password" class="form-control" name="password" value="" >
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="password_confirmation">Verificacion de contrasena </label><b class="text-danger">*</b>
                                            <input type="password" class="form-control" name="password_confirmation"
                                                value="" >
                                        </div>
                                    </div>
                                </div>

                        </div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <a href="{{ route('admin.profesores.index') }}" class="btn btn-secondary">
                                    Cancelar
                                    {{-- <i class="fa-solid fa-plus"></i> --}}
                                </a>
                                <button type="submit" class="btn btn-primary">Actualizar profesor</button>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>

            </div>
        </div>
        @stop

    @section('css')

    @stop

    @section('js')

    @stop
