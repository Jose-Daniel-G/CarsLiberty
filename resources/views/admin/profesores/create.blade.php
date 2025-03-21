@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Sistema de reservas </h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <h1>Registro de un nuevo profesores</h1>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Llene los Datos</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.profesores.store') }}" method="POST" autocomplete="off">
                            @csrf
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="nombres">Nombre del profesor </label><b>*</b>
                                        <input type="text" class="form-control" name="nombres"
                                            value="{{ old('nombres') }}" required>
                                        @error('nombres')
                                            <small class="bg-danger text-white p-1">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="apellidos">Apellidos </label><b>*</b>
                                        <input type="text" class="form-control" name="apellidos"
                                            value="{{ old('apellidos') }}" required>
                                        @error('apellidos')
                                            <small class="bg-danger text-white p-1">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="telefono">Telefono </label><b>*</b>
                                        <input type="number" class="form-control" name="telefono"
                                            value="{{ old('telefono') }}" required>
                                        @error('telefono')
                                            <small class="bg-danger text-white p-1">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                {{-- <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="especialidad">Especialidad </label><b>*</b>
                                        <input type="text" class="form-control" name="especialidad"
                                            value="{{ old('especialidad') }}" required>
                                        @error('especialidad')
                                            <small class="bg-danger text-white p-1">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div> --}}
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="email">Email </label><b>*</b>
                                        <input type="email" class="form-control" name="email"
                                            value="{{ old('email') }}" required>
                                        @error('email')
                                            <small class="bg-danger text-white p-1">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="password">Contrasena </label><b>*</b>
                                        <input type="password" class="form-control" name="password"
                                            value="{{ old('password') }}" required>
                                        @error('password')
                                            <small class="bg-danger text-white p-1">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="password_confirmation">Verificacion de contrasena </label><b>*</b>
                                        <input type="password" class="form-control" name="password_confirmation"
                                            value="{{ old('password_confirmation') }}" required>
                                        @error('password_confirmation')
                                            <small class="bg-danger text-white p-1">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                    </div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <a href="{{ route('admin.secretarias.index') }}" class="btn btn-secondary">
                                Cancelar
                                {{-- <i class="fa-solid fa-plus"></i> --}}
                            </a>
                            <button type="submit" class="btn btn-primary">Registrar profesores</button>
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
