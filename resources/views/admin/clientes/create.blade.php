@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Sistema de reservas </h1>
@stop

@section('content')
    <div class="container-fluid">

        <div class="row">
            <h1>Registro de nueva clientes</h1>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Llene los Datos</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.clientes.store') }}" method="POST" autocomplete="off">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="nombres">Nombres </label><b class="text-danger">*</b>
                                        <input type="text" class="form-control" name="nombres"
                                            value="{{ old('nombres') }}" required>
                                        @error('nombres')
                                            <small class="bg-danger text-white p-1">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="apellidos">Apellidos </label><b class="text-danger">*</b>
                                        <input type="text" class="form-control" name="apellidos"
                                            value="{{ old('apellidos') }}" required>
                                        @error('apellidos')
                                            <small class="bg-danger text-white p-1">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="cc">CC</label><b class="text-danger">*</b>
                                        <input type="number" class="form-control" name="cc"
                                            value="{{ old('cc') }}" required>
                                        @error('cc')
                                            <small class="bg-danger text-white p-1">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="celular">Celular </label><b class="text-danger">*</b>
                                        <input type="number" class="form-control" name="celular"
                                            value="{{ old('celular') }}" required>
                                        @error('celular')
                                            <small class="bg-danger text-white p-1">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="genero">Sexo </label><b class="text-danger">*</b>
                                        <select name="genero" id="genero" class="form-control">
                                            <!-- Opción por defecto -->
                                            <option value="" selected disabled>Seleccione una opción</option>
                                            <option value="M" {{ old('genero') == 'M' ? 'selected' : '' }}>Masculino
                                            </option>
                                            <option value="F" {{ old('genero') == 'F' ? 'selected' : '' }}>Femenino
                                            </option>
                                        </select>
                                        @error('genero')
                                            <small class="bg-danger text-white p-1">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="correo">Correo </label><b class="text-danger">*</b>
                                        <input type="email" class="form-control" name="correo"
                                            value="{{ old('correo') }}" required>
                                        @error('correo')
                                            <small class="bg-danger text-white p-1">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="direccion">Direccion </label><b class="text-danger">*</b>
                                        <input type="address" class="form-control" name="direccion"
                                            value="{{ old('direccion') }}" required>
                                        @error('direccion')
                                            <small class="bg-danger text-white p-1">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="contacto_emergencia">Contacto Emergencia</label><b class="text-danger">*</b>
                                        <input type="number" class="form-control" name="contacto_emergencia"
                                            value="{{ old('contacto_emergencia') }}" required>
                                    </div>
                                    @error('contacto_emergencia')
                                        <small class="bg-danger text-white p-1">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="password">Contrasena </label><b class="text-danger">*</b>
                                        <input type="password" class="form-control" name="password"
                                            value="{{ old('password') }}">
                                        @error('password')
                                            <small class="bg-danger text-white p-1">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="password_confirmation">Verificacion de contrasena </label><b class="text-danger">*</b>
                                        <input type="password" class="form-control" name="password_confirmation"
                                            value="{{ old('password_confirmation') }}">
                                        @error('password_confirmation')
                                            <small class="bg-danger text-white p-1">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Cursos que tomará:</label>
                                    <div class="row">
                                        @foreach ($cursos as $curso)
                                            <div class="col-md-2">
                                                <div class="form-check">
                                                    <input type="checkbox" name="cursos[]" value="{{ $curso->id }}" class="form-check-input" id="curso{{ $curso->id }}">
                                                    <label class="form-check-label" for="curso{{ $curso->id }}">
                                                        {{ $curso->nombre }}
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="observaciones">Observaciones</label>
                                        <textarea class="form-control" name="observaciones">{{ old('observaciones') }}</textarea>

                                    </div>
                                </div>
                            </div>
                    </div>

                </div>
            </div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <a href="{{ route('admin.clientes.index') }}" class="btn btn-secondary">
                        Cancelar
                        {{-- <i class="fa-solid fa-plus"></i> --}}
                    </a>
                    <button type="submit" class="btn btn-primary">Registrar cliente</button>
                </div>
            </div>
        </div>
        </form>
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
