    @extends('adminlte::page')

    @section('title', 'Dashboard')

    @section('content_header')
        <h1>Sistema de reservas </h1>
    @stop

    @section('content')

        <div class="row">
            <h1>Modificar Secretaria: {{ $secretaria->nombres }} {{ $secretaria->apellidos }}</h1>

        </div>
        <div class="row">
            <div class="col-md-10">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Datos</h3>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('admin.secretarias.update', $secretaria->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="nombres">Nombres </label><b class="text-danger">*</b>
                                        <input type="text" class="form-control" name="nombres"
                                            value="{{ $secretaria->nombres }}" required>
                                        @error('nombres')
                                            <small class="bg-danger text-white p-1">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="apellidos">Apellidos </label><b class="text-danger">*</b>
                                        <input type="text" class="form-control" name="apellidos"
                                            value="{{ $secretaria->apellidos }}" required>
                                        @error('apellidos')
                                            <small class="bg-danger text-white p-1">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="cc">Cc </label><b class="text-danger">*</b>
                                        <input type="text" class="form-control" name="cc"
                                            value="{{ $secretaria->cc }}" required>
                                        @error('cc')
                                            <small class="bg-danger text-white p-1">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="celular">Celular </label><b class="text-danger">*</b>
                                        <input type="text" class="form-control" name="celular"
                                            value="{{ $secretaria->celular }}" required>
                                        @error('celular')
                                            <small class="bg-danger text-white p-1">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row ">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="fecha_nacimiento">Fecha de Nacimiento </label><b class="text-danger">*</b>
                                        <input type="date" class="form-control" name="fecha_nacimiento"
                                        value="{{ old('fecha_nacimiento', \Carbon\Carbon::createFromFormat('d/m/Y', $secretaria->fecha_nacimiento)->format('Y-m-d')) }}" required>
                                        @error('fecha_nacimiento')
                                            <small class="bg-danger text-white p-1">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="direccion">Direccion </label><b class="text-danger">*</b>
                                        <input type="address" class="form-control" name="direccion"
                                            value="{{ $secretaria->direccion }}" required>
                                        @error('direccion')
                                            <small class="bg-danger text-white p-1">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="email">Email</label><b class="text-danger">*</b>
                                        <input type="email" class="form-control" name="email"
                                            value="{{ $secretaria->user->email }}" required>
                                    </div>
                                    @error('email')
                                        <small class="bg-danger text-white p-1">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="password">Contrasena</label>
                                        <input type="password" class="form-control" name="password"
                                            value="{{ old('password') }}">
                                    </div>
                                    @error('password')
                                        <small class="bg-danger text-white p-1">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="password_confirmation">Verificacion de contrasena</label>
                                        <input type="password" class="form-control" name="password_confirmation"
                                            value="{{ old('password_confirmation') }}">
                                    </div>
                                    @error('password_confirmation')
                                        <small class="bg-danger text-white p-1">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                                            Cancelar
                                            {{-- <i class="fa-solid fa-plus"></i> --}}
                                        </a>
                                        <button type="submit" class="btn btn-success">Actualizar secretaria</button>

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
